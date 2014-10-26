<?php namespace Arkraft\Alerts;

use \Session;
use \Config;

class Alerts {

    /**
     * Adds an info message
     *
     * @param $msg message of the alert
     * @param string $title title of the alert
     * @param array $config configuration for growl
     */
	public static function addInfo($msg, $title = "", $config = array()) {
		self::_addAlert('info', $msg, $title, $config);
	}

    /**
     * Adds a success message
     *
     * @param $msg message of the alert
     * @param string $title title of the alert
     * @param array $config configuration for growl
     */
	public static function addSuccess($msg, $title = "", $config = array()) {
		self::_addAlert('success', $msg, $title, $config);
	}

    /**
     * Adds a warning message
     *
     * @param $msg message of the alert
     * @param string $title title of the alert
     * @param array $config configuration for growl
     */
	public static function addWarning($msg, $title = "", $config = array()) {
		self::_addAlert('warning', $msg, $title, $config);
	}

    /**
     * Adds a danger message
     *
     * @param $msg message of the alert
     * @param string $title title of the alert
     * @param array $config configuration for growl
     */
	public static function addDanger($msg, $title = "", $config = array()) {
		self::_addAlert('danger', $msg, $title, $config);
	}

    /**
     * Main message to add alerts
     *
     * @param $class alert class for bootstrap
     * @param $msg message of the alert
     * @param $title title of the alert
     * @param $config configuration for growl
     */
    private static function _addAlert($class, $msg, $title, $config) {
        $offset = array_key_exists('offset', $config) ? $config['offset'] : Config::get('alerts::offset');
        $align = array_key_exists('align', $config) ? '"'.$config['align'].'"' : (string)'"'.Config::get('alerts::align').'"';
        $width = array_key_exists('width', $config) ? $config['width'] : (int)Config::get('alerts::width');
        $delay = array_key_exists('delay', $config) ? $config['delay'] : (int)Config::get('alerts::delay');
        $allowDismiss = array_key_exists('allowDismiss', $config) ? '"'.$config['allowDismiss'].'"' : '"'.Config::get('alerts::allowDismiss').'"';
        $stackupSpacing = array_key_exists('stackupSpacing', $config) ? $config['allowSpacing'] : Config::get('alerts::stackupSpacing');

        if($title != "") {
            $msg = '<strong>' . $title . ':</strong> ' . $msg;
        }
        $newAlert = "$.bootstrapGrowl(" . $msg . ", {
                        type: '" . $class . "',
                        offset: " . $offset . ",
                        align: " . $align . ",
                        width: " . $width . ",
                        delay: " . $delay . ",
                        allow_dismiss: " . $allowDismiss . ",
                        stackup_spacing: " . $stackupSpacing . "
                    });";
        $currentAlerts = Session::get('Arkraft-Alerts');
        $currentAlerts = str_replace("<!-- AlertManager --><script>", NULL, $currentAlerts);
        $currentAlerts = str_replace("</script><!-- /AlertManager -->", NULL, $currentAlerts);
        $currentAlerts = "<!-- AlertManager --><script>" . PHP_EOL .
            $currentAlerts .
            $newAlert .
            PHP_EOL .
            "</script><!-- /AlertManager -->" .PHP_EOL;
        Session::set('Arkraft-Alerts', $currentAlerts);
    }

    /**
     * Returns the strings for the view
     *
     * @return string
     */
    public static function getAlerts() {
        $alerts = Session::get('Arkraft-Alerts');
        Session::set('Arkraft-Alerts', NULL);
        return "<script src=\"packages/jquery/jquery.bootstrap-growl.min.js\"></script>" . PHP_EOL .
        $alerts;
    }

}
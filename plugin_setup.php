<?php

// Plugin setup script for XR18 Volume Control Plugin
$pluginName = "XR18VolumeControl";

if (isset($settings['fppMode']) && $settings['fppMode'] != "master") {
    return;
}

// Register the callbacks script
$callbackScript = $settings['pluginDirectory'] . "/$pluginName/callbacks.sh";
$pluginUpdateScript = $settings['pluginDirectory'] . "/$pluginName/update.sh";

// Register scripts with FPP
register_plugin_callback($pluginName, $callbackScript, true);
register_plugin_callback($pluginName . "_update", $pluginUpdateScript, true);

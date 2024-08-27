<?php
    $pluginJson = $settings['pluginDirectory'] . "/XR18VolumeControl/pluginInfo.json";
    $pluginData = json_decode(file_get_contents($pluginJson), true);
    $pluginName = $pluginData['name'];
    $configPage = $settings['pluginDirectory'] . "/XR18VolumeControl/config.php";
    $menuItems = array();
    $menuItems[$pluginName] = $configPage;
    ?>
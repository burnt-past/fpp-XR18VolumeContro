<?php
$pluginName = "XR18VolumeControl";
$scriptPath1 = "/home/fpp/media/plugins/$pluginName/Scripts/poll_volume.sh";
$scriptPath2 = "/home/fpp/media/plugins/$pluginName/Scripts/midi_listener.sh";

// Ensure the script is executable
chmod($scriptPath1, 0755);
chmod($scriptPath2, 0755);

// Start the script
exec("$scriptPath1 > /dev/null 2>&1 &");
exec("$scriptPath2 > /dev/null 2>&1 &");
?>
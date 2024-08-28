<?php
$pluginName = "XR18VolumeControl";
$scriptPath = "/home/fpp/media/plugins/$pluginName/poll_volume.sh";

// Ensure the script is executable
chmod($scriptPath, 0755);

// Start the script
exec("$scriptPath > /dev/null 2>&1 &");
?>
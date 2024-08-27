<?php
    if (isset($_POST['submit'])) {
        $device = $_POST['midi_device'];
        $channel = $_POST['midi_channel'];
        file_put_contents($settings['configDirectory'] . "/XR18VolumeControl.config", json_encode(array('device' => $device, 'channel' => $channel)));
    }
    $config = json_decode(file_get_contents($settings['configDirectory'] . "/XR18VolumeControl.config"), true);
    ?>
    <form method="post" action="config.php">
        MIDI Device: <input type="text" name="midi_device" value="<?php echo $config['device']; ?>">
        MIDI Channel: <input type="text" name="midi_channel" value="<?php echo $config['channel']; ?>">
        <input type="submit" name="submit" value="Save">
    </form>
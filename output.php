<?php
    $pluginName = "XR18VolumeControl";
    $MIDI_DEVICE = "hw:2,0,0";
    $CHANNEL_FADER_CC = "00";
    function convertVolumeToMidi($volume) {
        return dechex(intval($volume * 127 / 100));
    }
    function sendMidiCommand($volume) {
        global $MIDI_DEVICE, $CHANNEL_FADER_CC;
        $midiValue = convertVolumeToMidi($volume);
        $command = "amidi -p $MIDI_DEVICE -S 'B0 $CHANNEL_FADER_CC $midiValue'";
        exec($command);
    }
    if (isset($_POST['volume'])) {
        $volume = intval($_POST['volume']);
        sendMidiCommand($volume);
    }
    ?>
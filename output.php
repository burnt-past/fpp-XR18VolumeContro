<?php

$pluginName = "XR18VolumeControl";
$MIDI_DEVICE = "hw:2,0,0";  // Set this to your actual MIDI device path
$CHANNEL_FADER_CC = "00";  // MIDI CC number for Channel 1 fader

function convertVolumeToMidi($volume)
{
    return dechex(intval($volume * 127 / 100));
}

function sendMidiCommand($volume)
{
    global $MIDI_DEVICE, $CHANNEL_FADER_CC;

    $midiValue = convertVolumeToMidi($volume);
    $command = "amidi -p $MIDI_DEVICE -S 'B0 $CHANNEL_FADER_CC $midiValue'";

    // Execute the command
    exec($command);
}

function getFppVolume()
{
    $api_url = "http://localhost/api/fppd/volume";
    $json = file_get_contents($api_url);
    $data = json_decode($json, true);
    if ($data['Status'] == 'OK') {
        return intval($data['volume']);
    }
    return null;
}

// Fetch the current volume from FPP API
$volume = getFppVolume();

if ($volume !== null) {
    sendMidiCommand($volume);
} else {
    error_log("Failed to retrieve volume from FPP API.");
}

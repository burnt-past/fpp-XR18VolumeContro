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

    // Execute the MIDI command
    exec($command);

    // Update the system volume in FPP
    $api_url = "http://localhost/api/system/volume";
    $data = array('volume' => $volume);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($api_url, false, $context);

    // Echo result for debugging
    if ($result === FALSE) {
        echo "Failed to update system volume in FPP.";
    } else {
        echo "System volume updated to $volume.";
    }
}

function getFppVolume()
{
    $api_url = "http://localhost/api/system/volume";
    $json = file_get_contents($api_url);
    $data = json_decode($json, true);
    if ($data['status'] == 'OK') {
        return intval($data['volume']);
    }
    return null;
}

// Fetch the current volume from FPP API
$volume = getFppVolume();

if ($volume !== null) {
    sendMidiCommand($volume);
} else {
    echo "Failed to retrieve volume from FPP API.";
}

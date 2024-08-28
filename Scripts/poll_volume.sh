#!/bin/bash

# Previous volume tracker
prev_volume=""

while true; do
    # Get the current system volume from FPP
    current_volume=$(curl -s http://localhost/api/system/volume | jq -r '.volume')

    # If the volume has changed, update the MIDI device
    if [ "$current_volume" != "$prev_volume" ]; then
        echo "Volume changed to $current_volume. Updating MIDI..."
        
        # Convert volume to MIDI command and send it
        midi_value=$(printf "%02x" $((current_volume * 127 / 100)))
        amidi -p hw:2,0,0 -S "B0 00 $midi_value"

        # Update the previous volume
        prev_volume="$current_volume"
    fi

    # Sleep for a short time before polling again
    sleep 5
done

#! /usr/bin/env python
import serial
import sys
usb = '/dev/ttyUSB0'
vitesse = 115200
seri = sys.argv[1]
usb = sys.argv[2]
vitesse = int(sys.argv[3])

with serial.Serial(usb,vitesse, timeout=1) as ser:

    # check which port was really used
    ser.write(seri)
    ser.close()
#! /usr/bin/env python3
# coding: utf-8
import smbus
import time
import sys

# renplacer 0 par 1 si noveau raspberry
bus = smbus.SMBus(1)
try:
    argument = int(sys.argv[1])
except:
    argument = ord(sys.argv[1])

addrese = int(sys.argv[2])

bus.write_byte(addrese, argument)

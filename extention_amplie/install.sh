#!/bin/sh
$bassemoode = (/var/www/)
$moodedb = (/var/local/www/db/)
#----------------------------

apt-get install i2c-tools
apt-get install python-smbus
pip install pyserial
mv index1.php $bassemoode
mv parametre_control.php $bassemoode
mv header.php /var/local/www/
mv index.js $bassemoode/js/
mkdir script $bassemoode
mv serial1.py $bassemoode/script/
chown 0:50 cfg-BTN-sqlite3.db
chomod 777 cfg-BTN-sqlite3.db
mv cfg-BTN-sqlite3.db $moodedb 

sudo pip install pyserial
sudo apt-get install i2c-tools
sudo apt-get install python-smbus


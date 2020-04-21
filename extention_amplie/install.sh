#!/bin/sh
$bassemoode = /var/www/
$moodedb = /var/local/www/db/
#----------------------------
sudo apt-get install i2c-tools
sudo apt-get install python-smbus
sudo pip install pyserial
sudo mv index1.php $bassemoode
sudo mv parametre_control.php $bassemoode
sudo mv header.php /var/local/www/
sudo mv index.js $bassemoode/js/
sudo mkdir script $bassemoode
sudo mv serial1.py $bassemoode/script/
sudo chown 0:50 cfg-BTN-sqlite3.db
sudo chomod 777 cfg-BTN-sqlite3.db
sudo mv cfg-BTN-sqlite3.db $moodedb 



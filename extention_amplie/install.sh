#!/bin/sh

#----------------------------
sudo mkdir script /var/www/
sudo apt-get install i2c-tools
sudo apt-get install python-smbus
sudo pip install pyserial
sudo mv index1.php /var/www/
sudo mv parametre_control.php /var/www/
sudo mv header.php /var/local/www/
sudo mv index.js /var/www/js/
sudo mv serial1.py /var/www/script/
sudo mv cfg-BTN-sqlite3.db /var/local/www/db/
sudo chown 0:50 cfg-BTN-sqlite3.db
sudo chomod 777 cfg-BTN-sqlite3.db



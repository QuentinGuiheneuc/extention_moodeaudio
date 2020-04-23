#!/bin/sh

#----------------------------

apt-get install i2c-tools
apt-get install python-smbus
pip install pyserial
cp index1.php /var/www/
cp parametre_control.php /var/www/
cp header.php /var/local/www/
cp index.js /var/www/js/
mkdir script 
cp serial1.py /script/
cp I2c.py /script/
mv script /var/www/
cp cfg-BTN-sqlite3.db /var/local/www/db/
chown 0:50 cfg-BTN-sqlite3.db /var/local/www/db/
chmod 777 cfg-BTN-sqlite3.db /var/local/www/db/



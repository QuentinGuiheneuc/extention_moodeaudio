### TUTO INSTALL

##### Moode Audio version conpatible 6.4.2

```
sudo raspi-config
```

Puis :

1 Interfacing Options

2 enable I2C(P5)

3 enable Serial(P6)

4 Finish et redémarre le Raspberry Pi

```
reboot
```

Une fois que le Rasberry Pi à redémarre faite les l'etapes suivante :

- instalation.

  ```
  git clone https://github.com/QuentinGuiheneuc/extention_moodeaudio.git
  ```

  ```
  cd /extention_moodeaudio/extention_amplie/6.4.2/
  ```

  ```
  chmod +x install.sh
  ```

  ```
  sudo ./install.sh
  ```

- autorisation de lecture de la basse de donner.

  ```
  cd /var/local/www/db/
  ```

  ```
  chown 0:50 cfg-BTN-sqlite3.db
  ```

  ```
  chmod 777 cfg-BTN-sqlite3.db
  ```

TERMINER

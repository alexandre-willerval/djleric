# djleric

Dev of DJleric's website

## Getting Started

To get a copy of the project up and running on your local machine for 
development and testing purposes, just clone the current Github repository.
```
mkdir site_eric
git clone https://github.com/alexandre-willerval/djleric/ site_eric
```

If you want to recreate the same full dev environment as I have, you can add a "template-grayscale" directory.
```
cd site_eric
mkdir template-grayscale
git clone https://github.com/BlackrockDigital/startbootstrap-grayscale template-grayscale
```

Inside the PHP/ folder, you'll find some tests I ran in order to be able to send emails from a VM that is not provided by my hosting compagny 
(the one that provides me my domain name and my email adresses).
I finally managed to do it in two different ways: with the Swiftmailer library, and with a custom Sendmail configuration. Both are detailed below.

* For both solutions:
```
cd php
cp credentials.demo.php credentials.php
vim credentials.php
  - type in your email username and password
  - save and quit with: :wq
```

* Swiftmailer library:
```
composer require "swiftmailer/swiftmailer:^6.0"
```

* custom Sendmail configuration:
Prerequisite (already installed on my Ubuntu 16.04 VM):
```
sudo apt-get install sendmail sendmail-cf openssl
```
Configure Hosts:
```
sudo vim /etc/hosts
  - change the line "127.0.0.1 localhost" into: "127.0.0.1 localhost yourhostname" where yourhostname is the result of the command "hostname" 
  - save and quit with: :wq
sudo systemctl restart systemd-hostnamed
```
Create certificate:
```
cd /etc/mail
sudo mkdir certs
cd certs
sudo openssl req -new -x509 -keyout cakey.pem -out cacert.pem -days 3650
sudo openssl req -nodes -new -x509 -keyout sendmail.pem -out sendmail.pem -days 3650
```
Create authentication file:
```
cd /etc/mail
sudo mkdir auth
cd auth
sudo vim client-info
  - add the following informations (with your current credentials, email address, and so on...):
      AuthInfo:smtp.yourhosting.com “U:root” “I:youremail@yourdomain.com” “P:yourpassword” “M:PLAIN”
      AuthInfo:smtp.yourhosting.com:587 “U:root” “I:youremail@yourdomain.com” “P:yourpassword” “M:PLAIN”
  - save and quit with: :wq
sudo chmod 600 /etc/mail/auth/*
sudo makemap -r hash client-info.db < client-info
```
Edit Sendmail configuration:
```
sudo cp /etc/pki/tls/certs/ca-bundle.crt /etc/mail/certs/ca-bundle.crt
sudo vim sendmail.mc
  - add the next lines between "dnl # Default Mailer setup" and "MAILER_DEFINITIONS"
      define(`SMART_HOST',`[smtp.yourhosting.com]')dnl
      define(`RELAY_MAILER_ARGS',`TCP $h 587')dnl
      define(`ESMTP_MAILER_ARGS',`TCP $h 587')dnl
      define(`confAUTH_OPTIONS',`A p')dnl
      TRUST_AUTH_MECH(`EXTERNAL DIGEST-MD5 CRAM-MD5 LOGIN PLAIN')dnl
      define(`confAUTH_MECHANISMS',`EXTERNAL GSSAPI DIGEST-MD5 CRAM-MD5 LOGIN PLAIN')dnl
      FEATURE(`authinfo',`hash -o /etc/mail/auth/client-info.db')dnl
      define(`CERT_DIR',`/etc/mail/certs')dnl
      define(`confCACERT_PATH',`CERT_DIR')dnl
      define(`confCACERT',`CERT_DIR/ca-bundle.crt')dnl
      define(`confCRL',`CERT_DIR/ca-bundle.crt')dnl
      define(`confSERVER_CERT',`CERT_DIR/sendmail.pem')dnl
      define(`confSERVER_KEY',`CERT_DIR/cakey.pem')dnl
      define(`confCLIENT_CERT',`CERT_DIR/sendmail.pem')dnl
      define(`confCLIENT_KEY',`CERT_DIR/cakey.pem')dnl
  - save and quit with: :wq
```
Create sendmail.cf file and restart Sendmail:
```
cd /etc/mail
sudo make
sudo service sendmail restart
```

## Built With

* [Grayscale](https://github.com/BlackrockDigital/startbootstrap-grayscale) - 
A multipurpose one page Bootstrap theme created by Start Bootstrap.
* [Bootstrap](https://getbootstrap.com/) - The most popular HTML, CSS, and JS library in the world.
* [Font Awesome](https://fontawesome.com/) - The world's most popular and easiest to use icon set.
* [jQuery](https://jquery.com/) - The Write Less, Do More, JavaScript Library.
* [Swiftmailer](https://swiftmailer.symfony.com/) - Free Feature-rich PHP Mailer.

## Authors

* Alexandre Willerval - [alexandre.willerval.net](http://alexandre.willerval.net/)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

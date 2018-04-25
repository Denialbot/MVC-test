#! /bin/bash
apt-get install -y apache2
cp /vagrant/configs/example.com.conf /etc/apache2/sites-available/example.com.conf
a2ensite example.com.conf
a2enmod php7.0
a2enmod rewrite
systemctl restart apache2
rm -rf /var/www/html

#! /bin/bash

dpkg-reconfigure -f noninteractive

# Install MySQL Server in a Non-Interactive mode. Default root password will be "secret"
echo "mysql-server-5.7 mysql-server/root_password password secret" | sudo debconf-set-selections
echo "mysql-server-5.7 mysql-server/root_password_again password secret" | sudo debconf-set-selections
apt-get -y install mysql-server-5.7 php-mysql
mysql_secure_installation
mysql --user=root --password=secret -e "CREATE DATABASE IF NOT EXISTS example"
#mysql --user=root --password=secret example < /vagrant/database/dumps/example.sql
mysql --user=root --password=secret -e "USE example"

migrate_dir="/vagrant/database/migrate"
seed_dir="/vagrant/database/seeds"
echo $PWD

cd $migrate_dir

for filename in $migrate_dir/*.sql; do
 echo $filename
 mysql --user=root --password=secret example < $filename
done

for filename in $seed_dir/*.sql; do
 echo $filename
 mysql --user=root --password=secret example < $filename
done
systemctl restart apache2

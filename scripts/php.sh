#! /bin/bash
add-apt-repository ppa:ondrej/php
apt-get install -y software-properties-common
apt-get update
apt-get install --allow-unauthenticated -y php php7.0-mbstring

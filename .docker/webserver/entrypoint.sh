#!/bin/bash

a2enmod proxy
a2enmod proxy_fcgi
a2enmod rewrite
apachectl configtest
service apache2 start

chmod -R 777 /var/www/html/

while true; do sleep 10; done;

#!/bin/bash

mysqld --initialize-insecure

mysqld --user=root --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci --default-authentication-plugin=mysql_native_password --daemonize

mysql -u root < /usr/bin/init.sql

while true; do sleep 10; done;

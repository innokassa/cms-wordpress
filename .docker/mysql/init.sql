ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
GRANT ALL ON *.* to 'root'@'%' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;

CREATE DATABASE IF NOT EXISTS wordpress;
USE wordpress;

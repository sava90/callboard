1. MySQL
CREATE TABLE users (
  userId int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  login varchar(24) NOT NULL,
  fullName varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (userId)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
ROW_FORMAT = DYNAMIC;

CREATE TABLE ads (
  adId int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  userId int(10) UNSIGNED NOT NULL,
  title varchar(255) NOT NULL,
  body text NOT NULL,
  fileName varchar(15) NOT NULL,
  PRIMARY KEY (adId)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
ROW_FORMAT = DYNAMIC;

2. /app/Config.php - connect to DB

3. Settings nginx
/etc/nginx/

server {
        listen 80;
        root [your path]/web/;
        index index.php index.html;
        server_name [your domain];

        location ~ \.php$ {
                try_files $uri $uri/ /index.php?$args;
                fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include /etc/nginx/fastcgi_params;
        }
        include [your path]/www-rewrites.conf;
}


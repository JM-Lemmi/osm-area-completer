FROM trafex/php-nginx

COPY . /var/www/html/

VOLUME /var/www/html/projects

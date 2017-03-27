FROM debian:stable

LABEL com.mundistoner.author="Felipe Lopes - bolzin@gmail.com" \
      com.mundistoner.version="0.1"

ENV apiProjectSource="src/" \
    apiProjectDest="/var/www/html/" \
    apacheUser="www-data" \
    apiConfSource="conf/api.conf" \
    apiConfDest="/etc/apache2/sites-available/000-default.conf"

RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y apache2 php5 php5-curl vim less

RUN rm /var/www/html/index.html
COPY $apiConfSource $apiConfDest
RUN a2enmod rewrite
RUN a2enmod headers

COPY $apiProjectSource $apiProjectDest
RUN chown -R $apacheUser:$apacheUser $apiProjectDest

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]


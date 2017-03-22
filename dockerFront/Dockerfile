FROM debian:jessie

LABEL author="Felipe Lopes <bolzin@gmail.com>"
LABEL version="1.0"
LABEL description="This Dockerfile setup an webserver \
with Apache/PHP and deploy an api frontend client"

ENV apache_version="2.4.10" \
    php_version="5.6.30" \
    apache_modules="libapache2-mod-php5" \
    php_modules="php5-curl php5-json php5-openssl" \
    front_url="fmlopes.com.br" \
    front_source="src/front/*" \
    front_dest="/var/www/fmlopes.com.br/public_html/" \
    
# update/upgrade
RUN apt-get update && apt-get upgrade -y

# install web server
RUN apt-get install -y apache2=$apache_version
RUN apt-get install -y $apache_modules
RUN apt-get install -y php5=$php_version
RUN apt-get install -y $php_modules
RUN a2enmod rewrite

# configure frontend virtual host
COPY bin/vhost /usr/local/bin
RUN vhost $front_url www-data

# copy frontend project into container
COPY $front_source $front_dest

# reset webroot files ownership to www-data
RUN chown -R www-data:www-data $front_dest

EXPOSE 80


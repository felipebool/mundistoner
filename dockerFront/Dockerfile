FROM debian:jessie

LABEL author="Felipe Lopes <bolzin@gmail.com>"
LABEL version="1.0"
LABEL description="This Dockerfile setup an \
webserver with Apache/PHP and deploy an api client"

ENV apache_version="2.4.10" php_version="5.6.30" \
    apache_modules="libapache2-mod-php5" \
    php_modules="php5-curl php5-json" \
    front_url="mundistoner.localhost" \
    front_source="src/*" \
    front_dest="/var/www/mundistoner.localhost/public_html/" 
    
# update/upgrade
RUN apt-get update && apt-get upgrade -y

# install web server
RUN apt-get install -y apache2
RUN apt-get install -y $apache_modules
RUN apt-get install -y php5
RUN apt-get install -y $php_modules
RUN a2enmod rewrite

# configure api client virtual host
COPY bin/vhost /usr/local/bin
RUN vhost $front_url www-data

# copy api client project into container
COPY $front_source $front_dest

# reset webroot files ownership to www-data
RUN chown -R www-data:www-data $front_dest

# enable apache mod_rewrite module
RUN a2enmod rewrite
RUN echo Listen 8080 >> /etc/apache2/ports.conf
RUN service apache2 start

EXPOSE 8080


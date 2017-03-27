FROM nginx:stable

LABEL com.mundistoner.author="Felipe Lopes - bolzin@gmail.com" \
      com.mundistoner.version="0.1"

ENV configFileSource="conf/proxy.conf" \
    configFileDest="/etc/nginx/nginx.conf" \
    frontProjectSource="src/" \
    frontProjectDest="/var/www/html/"

COPY $configFileSource $configFileDest
RUN mkdir -p $frontProjectDest
COPY $frontProjectSource $frontProjectDest

EXPOSE 80


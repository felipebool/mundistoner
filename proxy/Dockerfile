FROM nginx:stable

LABEL com.mundistoner.author="Felipe Lopes - bolzin@gmail.com" \
      com.mundistoner.version="0.1"

ENV configFileSource="conf/proxy.conf" \
    configFileDest="/etc/nginx/nginx.conf" 

COPY $configFileSource $configFileDest

EXPOSE 80


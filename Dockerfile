FROM php:7.2-apache-stretch

LABEL   description="Installation d'Apache 2, PHP 7.2 et Phalcon" \
        maintainer="Jérémy PASTOURET <jeremy.pastouret@gmail.com>" \
        name="apache2_php7_phalcon_version"

# liste des arguments
ARG phalcon_version='v4.0.0'
ARG env='prod'

# Installation de Wget, Curl, gnupg, zip, unzip et libzip-dev
RUN apt update --fix-missing;
RUN apt install -y wget curl gnupg zip unzip libzip-dev

# Ajout de l'extension zip pour Composer
RUN docker-php-ext-install zip

# Installation de Git
RUN apt-get install -y git

RUN cd /tmp && git clone https://github.com/jbboehr/php-psr.git
RUN cd /tmp/php-psr && phpize && ./configure && make && make test && make install

RUN docker-php-ext-enable psr

# Aller dans le répertoire temporaire et télécharger le projet Phalcon
RUN cd /tmp && git clone "git://github.com/phalcon/cphalcon.git"

# Ouverture du nouveau répertoire
RUN cd /tmp/cphalcon && git checkout tags/$phalcon_version -b $phalcon_version

# Installation de php-dev gcc libpcre3-dev php-pgsql libpq-dev
RUN apt install gcc libpcre3-dev libpq-dev -y

# Ouverture du répertoire de compilation et installation
RUN cd /tmp/cphalcon/build && ./install 

# Activation de l'extension de phalcon
RUN docker-php-ext-enable phalcon

# Activation des extensions PostgreSql
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Activation de l'extension de réécriture d'URL
RUN a2enmod rewrite

# Redémarrage Apache
RUN /etc/init.d/apache2 restart
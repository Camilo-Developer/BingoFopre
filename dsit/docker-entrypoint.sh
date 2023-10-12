#!/bin/bash

set -e

if [[ "$1" == apache2* ]] || [ "$1" == php-fpm ]; then
                echo >&2 "Validando la instalación de Laravel || Uniandes"

#if ! [ -e index.php -a \( -e config/app.php -o -e config/app.php \) ]; then
if ! [ -d resources/ ]; then
                echo >&2 "Laravel not found in $(pwd) - copying now..."
                tar cf - --one-file-system -C /usr/src/laravel . | tar xf -
                
                rm -f app_laravel.tar
                chown -R www-data:www-data /var/www/html
                echo >&2 "Complete! Laravel has been successfully copied to $(pwd)"
fi


        envs=(
			LARAVEL_DB_HOST
			LARAVEL_DB_USER
			LARAVEL_DB_PASSWORD
			LARAVEL_DB_NAME
                        LARAVEL_APP_URL
                        APP_URL
                        DB_HOST
                        DB_PORT
                        DB_DATABASE
                        DB_USERNAME
                        DB_PASSWORD
		) 


#                if ! [ -d /var/www/html/resources ]; then
#                        echo >&2 "Inicializando carpeta de imagenes"
#                        mkdir /var/www/html/resources || true
#                        cp -r /var/www/html/_resources/* /var/www/html/resources
#                        chown -R www-data:www-data /var/www/html
#                        echo >&2 "Conectando a $LARAVEL_DB_USER"
#                        php /makedb.php "$LARAVEL_DB_HOST" "$LARAVEL_DB_USER" "$LARAVEL_DB_PASSWORD" "$LARAVEL_DB_NAME"
#                fi

                if ! [ -d /var/www/html/resources ]; then
                        echo >&2 "Inicializando carpeta de imagenes"
                        mkdir /var/www/html/resources || true
                        cp -r /var/www/html/_resources/* /var/www/html/resources
                        chown -R www-data:www-data /var/www/html
                        rm -rf /var/www/html/_resources/
                        echo >&2 "Conectando a $DB_USERNAME"
                        php /makedb.php "$DB_HOST" "$DB_USERNAME" "$DB_PASSWORD" "$DB_DATABASE"
                        composer install 
                fi

               



        echo >&2 "========================================================================"
        echo >&2
        echo >&2 " Este contenedor esta corriendo Laravel alpine!"
        echo >&2 "========================================================================"

fi

exec "$@"
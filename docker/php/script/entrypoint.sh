#!/bin/sh
cd /var/www

FILE=/var/www/.env

if [ ! -f $FILE ]; then
  cp /var/www/env /var/www/.env
fi

while true; do
  bash /var/www/docker/php/script/wait-for-it.sh db:3306 -s -t 20 -- echo "Database iniciado"

  if [[ $? -eq 0 ]]; then
    break
  fi
done

echo "Copying default XDEBUG ini"
sudo cp /home/xdebug/xdebug-default.ini /etc/php.d/xdebug.ini

if [[ $XDEBUG_MODES == *"profile"* ]]; then
    echo "Appending profile ini"
    sudo bash -c "cat /home/xdebug/xdebug-profile.ini >> /etc/php.d/xdebug.ini"
fi

if [[ $XDEBUG_MODES == *"debug"* ]]; then
    echo "Appending debug ini"
    sudo bash -c "cat /home/xdebug/xdebug-debug.ini >> /etc/php.d/xdebug.ini"

    echo "Setting Client Host to: $XDEBUG_CLIENT_HOST"
    sudo sed -i -e 's/xdebug.client_host = localhost/xdebug.client_host = '"${XDEBUG_CLIENT_HOST}"'/g' /etc/php.d/xdebug.ini

    echo "Setting Client Port to: $XDEBUG_CLIENT_PORT"
    sudo sed -i -e 's/xdebug.client_port = 9003/xdebug.client_port = '"${XDEBUG_CLIENT_PORT}"'/g' /etc/php.d/xdebug.ini

    echo "Setting IDE Key to: $IDE_KEY"
    sudo sed -i -e 's/xdebug.idekey = docker/xdebug.idekey = '"${IDE_KEY}"'/g' /etc/php.d/xdebug.ini
fi

if [[ $XDEBUG_MODES == *"trace"* ]]; then
    echo "Appending trace ini"
    sudo bash -c "cat /home/xdebug/xdebug-trace.ini >> /etc/php.d/xdebug.ini"
fi

if [[ "off" == $XDEBUG_MODES || -z $XDEBUG_MODES ]]; then
    echo "Disabling XDEBUG";
    sudo cp /home/xdebug/xdebug-off.ini /etc/php.d/xdebug.ini
else
    echo "Setting XDEBUG mode: $XDEBUG_MODES"
    sudo bash -c "echo -e '\n' >> /etc/php.d/xdebug.ini"
    sudo bash -c "echo 'xdebug.mode = $XDEBUG_MODES' >> /etc/php.d/xdebug.ini"
fi;

sudo mkdir -p /var/run/php-fpm
if [ ! -f /run/php-fpm/php-fpm.pid ]; then
  sudo touch /run/php-fpm/php-fpm.pid
fi

if [ ! -f /run/php-fpm/php-fpm.pid ]; then
  sudo touch /run/php-fpm/php-fpm.pid
fi

if [ ! -f /var/log/php-fpm/error.log ]; then
  sudo touch /var/log/php-fpm/error.log
fi

sudo chown 1000:1000 -R /var/log/php-fpm/
sudo chown 1000:1000 /run/php-fpm/php-fpm.pid

composer install

echo "Iniciando FPM, acesse: http://localhost:30000"
php-fpm -F

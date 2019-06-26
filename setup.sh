#!/bin/bash
php ~/Downloads/composer.phar --version
cp ~/Downloads/composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
# composer --version
composer create-project ~Desktop/laravelChecking myapp

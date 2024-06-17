#DOCKER
#### Install docker

1. https://docs.docker.com/engine/install/ - Docker
    * https://docs.docker.com/engine/install/linux-postinstall/ - Linux post-installation steps for Docker Engine
2. https://docs.docker.com/compose/ - Docker compose
    * https://github.com/docker/compose-switch Docker compose switch

### Install application

1. Register domain in /etc/host  `127.0.0.1 laravel.local`
2. run `cp .env.example .env`
3. run `docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs`
4. run `alias sail='bash vendor/bin/sail'`
5. run to build `sail build`
6. run to up containers `sail up -d`
7. run `sail artisan key:generate`
8. run `sail artisan migrate`
9. open http://laravel.local:8096


### Tools

#### 1 Artisan commands

1.1 sail artisan param1 param2 ...

1.2 Ex.: sail artisan migrate

#### 2 Composer commands

2.1 sail composer param1

2.2 Ex.: sail composer install

#### 3 Npm commands

3.1 sail npm param1

3.2 Ex.: sail npm install

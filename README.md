#DOCKER
#### Install docker

1. https://docs.docker.com/engine/install/ - Docker
    * https://docs.docker.com/engine/install/linux-postinstall/ - Linux post-installation steps for Docker Engine
2. https://docs.docker.com/compose/ - Docker compose
    * https://github.com/docker/compose-switch Docker compose switch

### Install application

1. Register domain in /etc/host  `127.0.0.1 laravel.local`
2. run `cp .env.example .env`
3. run `docker-compose up -d --build`
4. Open docker console
   * run `docker ps -a` to show container name. ex: laravel-app-laravel.test-1
   * run `docker exec -it laravel-app-laravel.test-1 bash`
   * run `composer install`
   * run `exit`
5. run `alias sail='bash vendor/bin/sail'`
6. recreate containers run `sail down` and `sail up -d`
7. run `sail artisan key:generate`
8. run `sail artisan migrate`


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

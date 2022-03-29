init: docker-network down build up install db-install frontend-install frontend-build update-chmod

install:
	docker-compose run --rm symfony-vehicle-php-cli composer install
	docker-compose run --rm symfony-vehicle-php-cli php bin/console do:database:drop -nq --force --if-exists
	docker-compose run --rm symfony-vehicle-php-cli bin/console doctrine:database:create -nq

frontend-install:
	docker-compose run --rm symfony-vehicle-php-cli npm install

frontend-build:
	docker-compose run --rm symfony-vehicle-php-cli npm run build

up:
	docker-compose up -d --remove-orphans

build:
	docker-compose build

down:
	docker-compose down -v --remove-orphans

docker-network:
	docker network create --driver=bridge --subnet=192.168.221.0/24 symfony-vehicle-network || true

update-chmod:
	sudo chown -R ${USER} ./app/var/ ./app/vendor/ ./app/node_modules/
	sudo chmod -R 777 ./app/var

db-install:
	docker-compose run --rm symfony-vehicle-php-cli bin/console doctrine:migrations:migrate --quiet
	docker-compose run --rm symfony-vehicle-php-cli bin/console doctrine:fixtures:load --no-interaction

default:
	@$(MAKE) -pRrq -f $(lastword $(MAKEFILE_LIST)) : 2>/dev/null | awk -v RS= -F: '/^# File/,/^# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | egrep -v -e '^[^[:alnum:]]' -e '^$@$$'
prepare:
	@uid=$$uid gid=$$gid docker-compose build
	@uid=$$UID gid=$$GID docker-compose up -d
	@mkdir -p $$HOME/.composer-cache
	@docker run --rm --interactive --tty --volume $$PWD:/app --volume $${COMPOSER_HOME:-$$HOME/.composer-cache}:/tmp --user $$(id -u):$$(id -g) composer install
	@chmod -R 777 storage
	@chmod -R 777 bootstrap/cache
	@docker exec -it still-delivery-back-php php artisan migrate:fresh
build:
	@uid=$$uid gid=$$gid docker-compose build
up:
	@uid=$$uid gid=$$gid docker-compose up -d
stop:
	@uid=$$uid gid=$$gid docker-compose stop
down:
	@uid=$$uid gid=$$gid docker-compose down
console:
	@docker exec -it still-delivery-back-php bash
php:
	@docker exec -it still-delivery-back-php php $(filter-out $@,$(MAKECMDGOALS))
test:
	@docker exec -it still-delivery-back-php vendor/bin/phpunit  --verbose tests/
testAction:
	@docker exec still-delivery-back-php bash -c "/var/www/html/vendor/bin/phpunit  --verbose /var/www/html/tests/"
analyse:
	@docker exec -it still-delivery-back-php vendor/bin/phpstan analyse
insights:
	@docker exec -it still-delivery-back-php php artisan insights
composer:
	@mkdir -p $$HOME/.composer-cache
	@docker run --rm --interactive --tty --volume $$PWD:/app --volume $${COMPOSER_HOME:-$$HOME/.composer-cache}:/tmp --user $$(id -u):$$(id -g) composer $(filter-out $@,$(MAKECMDGOALS))
%:
	@:e
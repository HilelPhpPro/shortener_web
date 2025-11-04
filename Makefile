.PHONY: up up-d up-b up-r down composer composer-install composer-update run cache-clear setup


-include .env

# Змінні для Docker
PROJECT_NAME ?= $(shell grep -m 1 'PROJECT_NAME' .env.local | cut -d '=' -f2-)

DOCKER_COMPOSE = docker-compose
PHP_BASH = docker exec -it php_$(PROJECT_NAME) /bin/bash
DOCKER_EXEC = $(PHP_BASH) -c

symfony-i: install-init

# Docker Compose Commands
up: setup
	$(DOCKER_COMPOSE) up

up-d: setup
	$(DOCKER_COMPOSE) up -d

up-b: setup
	$(DOCKER_COMPOSE) up --build

up-r: setup
	$(DOCKER_COMPOSE) up --force-recreate

down: setup
	$(DOCKER_COMPOSE) down

exec: setup
	$(DOCKER_EXEC) "echo -e '\033[32m'; /bin/bash"

# Composer Commands
composer: setup
	$(DOCKER_EXEC) "composer $(CMD)"

composer-install: CMD = install
composer-install: composer

composer-update: CMD = update
composer-update: composer

composer-i: composer-install
composer-u: composer-update

# Це скидає будь-які аргументи передані до 'run', роблячи їх не-цілями
%:
	@:

GREEN=\033[0;32m
BLACK=\033[0;30m
YELLOW_BG=\033[41m
RED=\033[0;31m
BLUE=\033[0;34m
YELLOW=\033[1;33m
PURPLE=\033[0;35m
NC=\033[0m


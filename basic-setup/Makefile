include .env

COLOUR_GREEN=\033[0;32m
COLOUR_RED=\033[0;31m
COLOUR_BLUE=\033[0;34m
COLOUR_END=\033[0m

.DEFAULT_GOAL:=help

.PHONY: help
help: ## Display this help message
	@echo -e '${COLOUR_RED}Usage: make <command>${COLOUR_END}\n'
	@cat $(MAKEFILE_LIST) | grep '^[a-zA-Z]'  | \
	    awk -F ':.*?## ' 'NF==2 {printf "  %-26s%s\n\n", $$1, "${COLOUR_GREEN}"$$2"${COLOUR_END}"}'

.PHONY: setup
setup: ## Rebuilds and/or sets up de default environment. Variables in .env concerning
	docker-compose up -d

.PHONY: stop
stop: ## Stops the containers
	docker-compose stop	

.PHONY: down
down: ## Stops and removes the containers
	docker-compose down

.PHONY: weblogs
weblogs: ## creates logs of web container
	docker logs -f "${PREFIX_CONTAINER}horde_web"

.PHONY: test
test: ## creates logs of web container
	echo ${PREFIX_CONTAINER}

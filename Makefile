COMPOSER_CMD=composer
SYMFONY_CMD=bin/console

help:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

dev-init:                                                                      ## setup application
	$(COMPOSER_CMD) install
	$(SYMFONY_CMD) doctrine:database:drop --force
	$(SYMFONY_CMD) doctrine:database:create
	$(SYMFONY_CMD) doctrine:schema:create
	$(SYMFONY_CMD) hautelook:fixtures:load -n -vvv --no-bundles

fixtures:                                                                      ## load fixtures
	$(SYMFONY_CMD) hautelook:fixtures:load -n -vvv --no-bundles

deptrac:																	   ## run deptrac
	php deptrac.phar

.PHONY: help dev-init fixtures deptrac
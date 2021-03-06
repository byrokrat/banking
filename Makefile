COMPOSER_CMD=composer
PHIVE_CMD=phive

PHPUNIT_CMD=vendor/bin/phpunit
README_TESTER_CMD=tools/readme-tester
PHPSTAN_CMD=tools/phpstan
PHPCS_CMD=tools/phpcs

TARGET=src/Format/FormatFactory.php
DEV_FILES:=$(shell find dev/ -type f -name '*')

.DEFAULT_GOAL=all

.PHONY: all
all: build test analyze

.PHONY: clean
clean:
	rm composer.lock
	rm -rf vendor
	rm -rf tools

.PHONY: build
build: $(TARGET)

$(TARGET): vendor/installed $(DEV_FILES)
	php dev/build_formats.php

.PHONY: test
test: phpunit docs

.PHONY: phpunit
phpunit: vendor/installed $(PHPUNIT_CMD)
	$(PHPUNIT_CMD)

.PHONY: docs
docs: vendor/installed $(README_TESTER_CMD)
	$(README_TESTER_CMD) README.md

.PHONY: analyze
analyze: phpstan phpcs

.PHONY: phpstan
phpstan: vendor/installed $(PHPSTAN_CMD)
	$(PHPSTAN_CMD) analyze -l 8 src

.PHONY: phpcs
phpcs: $(PHPCS_CMD)
	$(PHPCS_CMD)

composer.lock: composer.json
	@echo composer.lock is not up to date

vendor/installed: composer.lock
	$(COMPOSER_CMD) install
	touch $@

tools/installed:
	$(PHIVE_CMD) install --force-accept-unsigned --trust-gpg-keys 4AA394086372C20A,CF1A108D0E7AE720,31C7E470E2138192
	touch $@

$(README_TESTER_CMD): tools/installed
$(PHPSTAN_CMD): tools/installed
$(PHPCS_CMD): tools/installed
$(PHPUNIT_CMD): vendor/installed

install:
	composer install --no-interaction

qa: parallel-lint phpcs phpmd phpcpd

parallel-lint:
	vendor/bin/parallel-lint -e php src/

phpcs:
	vendor/bin/phpcs --standard=PSR2 src/

phpmd:
	vendor/bin/phpmd src/ text codesize,unusedcode,naming

phpcpd:
	vendor/bin/phpcpd src/

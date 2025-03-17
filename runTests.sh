#!/bin/bash

echo "Executando os testes..."
docker exec -it mvc-app bash -c "./vendor/bin/phpunit"

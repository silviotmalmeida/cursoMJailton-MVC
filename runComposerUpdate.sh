#!/bin/bash

echo "Atualizando as dependências..."
docker exec -it mvc-app bash -c "composer update"

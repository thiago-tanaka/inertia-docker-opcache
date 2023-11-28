#!/bin/bash
git pull
docker exec -it app php artisan migrate
docker exec -it app php artisan config:clear
docker exec -it app php artisan cache:clear
docker exec -it app php artisan view:clear
docker exec -it app php artisan route:clear

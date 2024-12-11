@ECHO OFF

REM call npm install --omit=dev
REM call npm install

REM call composer install --optimize-autoloader --no-dev
REM call composer install

REM call npm run build

call php artisan config:clear
call php artisan config:cache

call php artisan storage:link

call php artisan view:cache
call php artisan route:cache
call php artisan event:cache

call php artisan optimize

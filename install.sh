
echo "install composer dependences..."

composer install

echo "install npm dependences and build webpack..."

npm i && npm audit fix && npm run dev

echo "generate application key..."

php artisan key:generate

echo "migrating..."

php artisan migrate

echo "seeding..."

php artisan db:seed

echo 'public currency config'

php artisan vendor:publish --provider='Currency\CurrencyServiceProvider'

echo "fill up to date currency vaults..."

php artisan currency-update-vault

echo 'clear cache...'

php artisan cache:clear

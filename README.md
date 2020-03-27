## Virtual Money Wallet

## Installation

* Copy .env.example to .env
* Open terminal and run ./install.sh file

## Features

* Authentication
* Social Authentication (Not Finished)
* Email Verification Before Any other action
* Require to create new Wallet on first login
* Wallets per user are unlimited
* Wallet has type, name and currency
* Gate based (Authorized) transactions
* Transactions can be of type
    * Debit
    * Credit
* Updating wallet balance based on transaction type and currency
* In dashboard user can see
   * Wallets count 
   * his/her total balance by system currency
* System currency can be defined in currency.php config
* Easy To add new currency exchange provider
* Command to update exchange rates: php artisan currency-update-vault

## Testing

* Not Finished

## Dependencies

* Laravel ^7.*
* Laravel Socialite
* Guzzle HTTP
* ExchangeCurrencyRate API (for currencies conversation)

## Author

Varazdat Stepanyan

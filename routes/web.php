<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('login/callback/{provider}', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

Route::get('/', 'HomeController@index')->middleware([
    'auth',
    'verified',
    'has.wallet'
])->name('home');

Route::middleware(['auth', 'verified'])->prefix('wallets')->name('wallet.')->group(function (\Illuminate\Routing\Router $router) {
    $router->get('/', 'WalletController@index')->name('index');
    $router->get('/create', 'WalletController@create')->name('create');
    $router->post('/', 'WalletController@store')->name('store');

    $router->prefix('{wallet_id}/transactions')->name('transaction.')->namespace('Wallet')->group(function () use ($router) {
        $router->get('/', 'TransactionController@index')->name('index');
        $router->get('/create', 'TransactionController@create')->name('create');
        $router->post('/', 'TransactionController@store')->name('store');
    });

});

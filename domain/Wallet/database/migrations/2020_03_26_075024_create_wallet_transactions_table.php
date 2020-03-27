<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {

            $config = include __DIR__ . '/../../config/wallet.php';
            $currencyConfig = $config['tables']['currencies'];

            $table->id();
            $table->unsignedTinyInteger('type');
            $table->foreignId('wallet_id');
            $table->{$currencyConfig['key_type']}('currency_id');
            $table->float('amount');
            $table->foreign('currency_id')->references($currencyConfig['foreign_key'])->on($currencyConfig['table_name']);
            $table->timestamp('transaction_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
}

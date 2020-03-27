<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {

            $config = include __DIR__ . '/../../config/wallet.php';
            $usersConfig = $config['tables']['users'];
            $currencyConfig = $config['tables']['currencies'];

            $table->smallIncrements('id');
            $table->{$usersConfig['key_type']}('user_id');
            $table->{$currencyConfig['key_type']}('currency_id');
            $table->unsignedTinyInteger('type');
            $table->string('name');
            $table->float('balance');
            $table->timestamps();
            $table->foreign('user_id')->references($usersConfig['foreign_key'])->on($usersConfig['table_name']);
            $table->foreign('currency_id')->references($currencyConfig['foreign_key'])->on($currencyConfig['table_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}

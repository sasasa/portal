<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            // 店舗名 shop_name
            $table->string('shop_name');
            // 所在地 location
            $table->string('location')->index();
            // 電話番号 phone_number
            $table->string('phone_number');
            // メールアドレス shop_mail
            $table->string('shop_mail');
            // URL url
            $table->text('url');
            // 説明文 description
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}

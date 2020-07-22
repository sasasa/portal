<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_requests', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->index();
            $table->biginteger('shop_id')->index();

            // 名前（非公表です）
            $table->string('request_name');
            // 申請メルアド(非公表です)
            $table->string('request_email');
            // 申請TEL
            $table->string('request_tel');
            // 申請住所
            $table->string('request_address');
            // 営業許可証的な画像
            $table->string('license_path');

            // 受理されたかどうか
            $table->boolean('accept_flg')->default(false);

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
        Schema::dropIfExists('link_requests');
    }
}

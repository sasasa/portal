<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnParentIdToEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->biginteger('parent_id')->nullable()->index()->after('shop_id')->comment('親投稿のID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
}

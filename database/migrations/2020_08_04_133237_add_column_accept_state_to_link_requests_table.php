<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAcceptStateToLinkRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('link_requests', function (Blueprint $table) {
            // initial accept reject
            $table->string('accept_state')->default('initial')->after('license_path')->comment('申請の状況');
            $table->text('reason')->nullable()->after('license_path')->comment('申請拒否の理由');
            $table->dropColumn('accept_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('link_requests', function (Blueprint $table) {
            $table->dropColumn('accept_state');
            $table->dropColumn('reason');
            $table->boolean('accept_flg')->default(false);
        });
    }
}

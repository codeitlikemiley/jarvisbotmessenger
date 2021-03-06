<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLabelToResponds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responds', function (Blueprint $table) {
            $table->string('label')->nullable()->default(null)->after('title')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responds', function (Blueprint $table) {
            $table->dropColumn('label');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatAndNoHpToWebProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_profile', function (Blueprint $table) {
            $table->string('alamat')->after('link_wa');
            $table->string('no_hp', 15)->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_profile', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('no_hp');
        });
    }
}

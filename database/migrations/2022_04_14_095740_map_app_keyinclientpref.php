<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MapAppKeyinclientpref extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_preferences', function (Blueprint $table) {
            $table->string('map_key_for_app')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_preferences', function (Blueprint $table) {
            $table->string('map_key_for_app');
        });
    }
}

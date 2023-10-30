<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTopBarTexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_bar_texts', function (Blueprint $table) {
            $table->string('redirect_category_id')->nullable();
            $table->string('redirect_vendor_id')->nullable();
            $table->string('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('top_bar_texts', function (Blueprint $table) {
            $table->dropColumn('redirect_category_id');
            $table->dropColumn('redirect_vendor_id');
            $table->dropColumn('link');
        });
    }
}

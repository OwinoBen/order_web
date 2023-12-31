<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('verification_option_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('response_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 Pending, 1 Approved, 2 Rejected');
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
        Schema::dropIfExists('user_verification');
    }
}

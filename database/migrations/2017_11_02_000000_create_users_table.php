<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('user_type_id')->unsigned();
            $table->boolean('activated')->default(false);
            $table->boolean('approved')->default(false);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('sex')->nullable();
            $table->string('sex_orientation')->nullable();
            $table->string('ancestry')->nullable();
            $table->string('breast_size')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('tattoos')->nullable();
            $table->string('piercings')->nullable();
            $table->string('body_hair')->nullable();
            $table->string('intimate')->nullable();
            $table->string('smoker')->nullable();
            $table->string('alcohol')->nullable();
            $table->string('about_me')->nullable();
            $table->string('photos')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('canton_id')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('working_time')->nullable();
            $table->integer('package1_id')->unsigned()->nullable();
            $table->integer('package2_id')->unsigned()->nullable();
            $table->timestamp('package1_activation_date')->nullable();
            $table->timestamp('package2_activation_date')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('canton_id')->references('id')->on('cantons')->onDelete('cascade');
            // $table->foreign('package1_id')->references('id')->on('packages')->onDelete('cascade');
            // $table->foreign('package2_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_account');
            $table->string('email')         ->unique();
            $table->string('tel_number')    ->unique();
            $table->string('password');
            $table->rememberToken();

            $table->string('last_name',     50);
            $table->string('first_name',    50);
            $table->string('middle_name',   50);

            $table->date('birth_date');
            $table->string('city',          100);
            $table->string('street',        100);
            $table->string('house',         100);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

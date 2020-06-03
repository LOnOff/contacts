<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('u_id')->unsigned();
            $table->foreign     ('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->string      ('tel_number')    ->unique();
            $table->string      ('last_name',     50);
            $table->string      ('first_name',    50);
            $table->string      ('middle_name',   50);
            $table->timestamps  ();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}

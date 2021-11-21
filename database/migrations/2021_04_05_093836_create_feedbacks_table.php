<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 10)->nullable()->comment('Язык на котором подается обращение');
            $table->string('name', 255)->nullable()->comment('Имя');
            $table->string('phone')->nullable()->comment('Телефон');
            $table->string('organization')->nullable()->comment('Название организации');
            $table->text('message')->nullable()->comment('Сообщение');
            $table->ipAddress('ip')->nullable();
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
        Schema::dropIfExists('feedbacks');
    }
}

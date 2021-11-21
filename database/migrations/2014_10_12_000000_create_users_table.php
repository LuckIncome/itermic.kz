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
            $table->integer('good')->nullable()->default(0);
            $table->integer('admin')->nullable()->default(0);
            $table->integer('role_id')->nullable();
            $table->string('email')->unique()->nullable();

            $table->string('iin', 20)->nullable()->comment('ИИН пользователя');
            $table->string('surname')->nullable()->comment('Фамилия');
            $table->string('name')->nullable()->comment('Имя');
            $table->string('patronymic')->nullable()->comment('Отчество');
            $table->dateTime('last_login')->nullable()->comment('Последний раз онлайн');
            $table->boolean('locked')->nullable()->comment('Заблокирован');
            $table->string('address')->nullable()->comment('Адрес');
            $table->string('homephone')->nullable()->comment('Домашний телефон');
            $table->string('mobile')->nullable()->comment('Мобильный телефон');
            $table->string('language', 5)->nullable()->comment('Язык (ru, kz, en)');
            $table->dateTime('verify_at')->nullable()->comment('Истечение времени на подтверждение');
            $table->dateTime('password_requested_at')->nullable()->comment('Ограничение времени на восстановление пароля');
            $table->string('photo')->nullable()->comment('Фото профиля');

            $table->string('password');
            $table->rememberToken();
            $table->string('verify')->nullable();
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
        Schema::dropIfExists('users');
    }
}

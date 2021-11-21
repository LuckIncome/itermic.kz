<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id');
            $table->integer('rubric_id')->nullable()->comment('Рубрика');
            $table->boolean('fixed')->default(false)->comment('Зафиксировать новость на главной');

            foreach (\App\Models\Langs::all() as $lang) {
                $table->integer('good_' . $lang->key);
                $table->string('title_' . $lang->key)->nullable();
                $table->text('short_' . $lang->key)->nullable();
                $table->mediumText('full_' . $lang->key)->nullable();
                $table->string('additionally_' . $lang->key)->nullable();
            }

            $table->integer('update_user')->nullable();
            $table->integer('created_user')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->integer('view')->default(0)->nullable()->comment('Кол-во просмотров');
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
        Schema::dropIfExists('news');
    }
}

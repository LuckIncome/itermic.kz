<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->nullable();
            $table->integer('rubric_id')->nullable()->comment('Рубрика');
            $table->integer('news_id')->nullable();
            $table->integer('expert_id')->nullable();
            $table->integer('good')->default(1);

            foreach (\App\Models\Langs::all() as $lang) {
                $table->boolean('switch_' . $lang->key)->default(true)->comment('Показать картинку');
                $table->string('title_' . $lang->key)->nullable();
            }

            $table->integer('main')->default(0);
            $table->string('type', 30)->nullable();
            $table->string('lang', 10)->nullable();
            $table->integer('sind')->nullable();
            $table->string('link')->nullable();

            $table->dateTime('publish_at');
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
        Schema::dropIfExists('media');
    }
}

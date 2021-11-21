<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->text('rubric')->nullable()->comment('Поддержка рубрик');
            $table->boolean('submenu')->default(false)->comment('Показывать подменю на странице');
            $table->integer('good')->nullable();
            $table->integer('menu')->nullable();
            $table->integer('order')->default(0);
            $table->string('type')->nullable();
            $table->string('link')->nullable();

            foreach (\App\Models\Langs::all() as $lang) {
                $table->string('name_' . $lang->key)->nullable();
            }

            $table->integer('template')->nullable();
            $table->integer('col')->nullable();
            $table->string('alias')->nullable();
            $table->string('classes')->nullable()->comment('Класс для разметки');
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
        Schema::dropIfExists('sections');
    }
}

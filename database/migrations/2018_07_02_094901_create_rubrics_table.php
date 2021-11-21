<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->nullable();

            foreach (\App\Models\Langs::all() as $lang) {
                $table->integer('good_' . $lang->key)->default(1);
                $table->string('title_' . $lang->key)->nullable();
                $table->text('description_' . $lang->key)->nullable();
                $table->string('image_' . $lang->key)->nullable();
            }

            $table->integer('update_user')->nullable();
            $table->integer('created_user')->nullable();
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('rubrics');
    }
}

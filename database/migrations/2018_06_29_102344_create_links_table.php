<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->nullable();
            $table->integer('rubric_id')->nullable();

            foreach (\App\Models\Langs::all() as $lang) {
                $table->integer('good_' . $lang->key)->default(0)->nullable();
                $table->string('link_' . $lang->key)->nullable();
                $table->string('title_' . $lang->key)->nullable();
                $table->text('description_' . $lang->key)->nullable();
                $table->string('photo_' . $lang->key)->nullable();
            }

            $table->string('class')->nullable();
            $table->dateTime('published_at');
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
        Schema::dropIfExists('links');
    }
}

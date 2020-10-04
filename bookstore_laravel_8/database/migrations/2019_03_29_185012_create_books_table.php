<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->string('title');
            $table->string('isbn')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('publish_year')->nullable();
            $table->unsignedInteger('number_of_pages');
            $table->unsignedInteger('number_of_copies');
            $table->decimal('price', 8, 2);
            $table->string('cover_image');
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');
            
            $table->foreign('publisher_id')
                  ->references('id')
                  ->on('publishers')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_loans", function (Blueprint $table) {
            $table->id();
            $table->date("effective_date");
            $table->date("expired_date");
            $table->integer("user_id");
            $table->integer("book_id");
            $table->integer("quantity");
            $table->enum("status", ["borrowed","returned","lost"])->default("borrowed");
            $table->timestamp("return_date");
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
        Schema::dropIfExists('user_loans');
    }
};

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
        Schema::create('book_turnovers', function (Blueprint $table) {
            $table->id();
            $table->integer("book_id");
            $table->integer("user_id");
            $table->integer("user_loan_id");
            $table->decimal("cash_amount", 10, 2);
            $table->integer("quantity");
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
        Schema::dropIfExists('book_turnovers');
    }
};

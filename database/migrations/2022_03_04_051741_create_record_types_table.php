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
        Schema::create('record_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icon')->nullable();
            $table->string('name', 100);
            $table->string('description', 100);
            $table->enum('offset', [
                'income',
                'expense',
                'transfer'
            ]);
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
        Schema::dropIfExists('record_types');
    }
};

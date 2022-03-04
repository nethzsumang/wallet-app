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
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('record_type_id');
            $table->unsignedBigInteger('account_summary_id');
            $table->float('amount', 12, 2, true);
            $table->timestamps();

            $table->foreign('record_type_id')
                ->references('id')
                ->on('record_types');
            
            $table->foreign('account_summary_id')
                ->references('id')
                ->on('account_summaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
};

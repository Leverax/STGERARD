<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schooling_details', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('amount');
            $table->string('total');
            $table->integer('tranche');
            $table->integer('backward')->default(0);
            $table->integer('total_backward')->default(0);
            $table->string('author')->nullable();
            $table->boolean('generate')->default(false);
            $table->foreignId('schoolings_id')->constrained('schoolings')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('schooling_details');
    }
}

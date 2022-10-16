<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolings', function (Blueprint $table) {
            $table->id();
            $table->integer('rest');
            $table->integer('total');
            $table->integer('backward')->default(0);
            $table->foreignId('academic_years_id')->constrained('academic_years')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classrooms_id')->constrained('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('students_id')->constrained('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('schoolings');
    }
}

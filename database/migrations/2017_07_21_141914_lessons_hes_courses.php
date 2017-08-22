<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LessonsHesCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('lessons_has_courses', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('lesson_id');
        $table->integer('courses_id');
        $table->integer('user_id');
    
         });
         }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('lessons_has_courses');
    }
}

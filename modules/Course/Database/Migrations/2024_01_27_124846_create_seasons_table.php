<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->tinyInteger('number')->unsigned();
            $table->enum('confirmation_status', \Course\Models\Season::$confirmationStatuses)->default(\Course\Models\Season::CONFIRMATION_STATUS_PENDING);
            $table->enum('status', \Course\Models\Season::$statuses)->default(\Course\Models\Season::STATUS_OPENED);
            $table->timestamps();


            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}

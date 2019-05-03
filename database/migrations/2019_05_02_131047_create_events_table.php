<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asso_id')->nullable();
            $table->boolean('all_day')->default(0);
            $table->datetime('start');
            $table->datetime('end');
            $table->string('title');
            $table->string('url')->nullable();
            $table->unsignedBigInteger('source')->nullable();
            $table->timestamps();

            $table->foreign('asso_id')
                ->references('id')->on('associations')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('source')
                ->references('id')->on('events')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}

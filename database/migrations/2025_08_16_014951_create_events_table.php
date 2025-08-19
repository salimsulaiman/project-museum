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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->foreignId('event_category_id')->constrained('event_categories')->onDelete('cascade');
            $table->foreignId('event_location_id')->constrained('event_locations')->onDelete('cascade');
            $table->text('location_detail');
            $table->text('content');
            $table->integer('standing')->nullable();
            $table->integer('classroom')->nullable();
            $table->integer('round_table')->nullable();
            $table->integer('u_shape')->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->string('facility');
            $table->integer('max_participant');
            $table->string('contact');
            $table->string('pic');
            $table->string('description');
            $table->boolean('status')->default(false);
            $table->dateTime('starting_date');
            $table->dateTime('ending_date');
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
        Schema::dropIfExists('events');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->string('status');
            $table->string('description');
            $table->timestamps();
            $table->foreign('created_by', 'assigned_created_by')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id')
                ->on('users');
            $table->foreign('assigned_to', 'assigned_assigned_to')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id')
                ->on('users');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}

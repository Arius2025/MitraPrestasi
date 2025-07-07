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
    Schema::create('lomba_files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lomba_id')->constrained('lombas')->onDelete('cascade');
        $table->string('filename');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('lomba_files');
}

};

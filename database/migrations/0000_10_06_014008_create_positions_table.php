<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};

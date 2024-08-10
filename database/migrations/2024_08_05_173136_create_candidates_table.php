<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('leader_id');
            $table->string('fullname', 100);
            $table->string('nickname', 100);
            $table->string('phone', 50);
            $table->string('mail', 50);
            $table->string('gender', 50);
            $table->string('neighbour', 50);
            $table->string('address', 100);
            $table->string('birthday', 100);
            $table->boolean('process')->default(false);
            $table->timestamps();
            $table->foreign('leader_id')->references('id')->on('barangs')->onDelete('cascade');
     

        });
    }

  

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
        });
    
        Schema::dropIfExists('candidates');
    }
};

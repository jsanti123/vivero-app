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
        Schema::create('viveros', function (Blueprint $table) {
            $table->string('codigo')->primary();
            $table->string('cultivo');
            $table->string('num_catastro')->nullable();
            $table->string('municipio')->nullable();
            $table->foreign(['num_catastro', 'municipio'])
            ->references(['num_catastro', 'municipio'])->on('fincas')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viveros');
    }
};

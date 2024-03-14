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
        Schema::create('labor_producto', function (Blueprint $table) {
            $table->id();

            $table->foreignId('labor_id')
            ->nullable()
            ->constrained('labores')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->string('producto_id')->nullable();
            $table->foreign('producto_id')
            ->references('ICA')->on('productoscontrol')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            //periodo de carencia
            $table->integer('periodo_carencia')->nullable();
            //fecha de ultima aplicacion
            $table->date('fecha_ultima_aplicacion')->nullable();
            //nombre del hongo  que afecta
            $table->string('hongo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labor_producto');
    }
};

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
        Schema::create('cursos_registrados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_matricula');
            $table->string('grupo');
            $table->tinyInteger('nivel');
            $table->date('fecha_fin_curso')->nullable();
            $table->decimal('definitiva', 5, 2)->nullable(); // Calificación
            $table->boolean('aprobado')->default(false);
            $table->boolean('aplazado')->default(false);
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos_registrados');
    }
};

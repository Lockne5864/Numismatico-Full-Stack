<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tabelao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('money_id'); // Adiciona a coluna de chave estrangeira
            $table->unsignedBigInteger('collection_id'); // Adiciona a coluna de chave estrangeira
            $table->foreign('money_id')->references('id')->on('money')->onDelete("cascade"); // Define a relação
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete("cascade");
			$table->unsignedBigInteger("user_id");
			$table->foreign("user_id")
				->references("id")
				->on("users")
				->onDelete("cascade");
            $table->timestamps();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabelao');
    }
};

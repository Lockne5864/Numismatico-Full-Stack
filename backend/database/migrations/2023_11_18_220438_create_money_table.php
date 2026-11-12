<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('money', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->integer('year')->nullable(); // or use a specific date format
			$table->string('country')->nullable();
			$table->string('condition')->nullable();
			$table->decimal('price', 15, 2)->nullable(); // Example for price with two decimal places
			$table->text('observation')->nullable();
			$table->string('type')->nullable();
			$table->string('material')->nullable();
			$table->boolean('available_sell')->nullable();
			$table->longText('url_img')->nullable();

			$table->unsignedBigInteger("user_id");
			$table->foreign("user_id")
				->references("id")
				->on("users")
				->onDelete("cascade");

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('money');
	}
};

<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('permissions', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->foreignId('permission_category_id')->constrained()->onDelete('cascade');

			$table->unique(['name', 'permission_category_id']);
		});

		$actions = ['view', 'create', 'edit', 'delete'];
        $categories = DB::table('permission_categories')->pluck('id', 'name');

        foreach($categories as $categoryName => $categoryId) {
            foreach($actions as $action) {
                if (rand(0, 1)) {
                    $permissionName = strtolower($action . '_' . str_replace(' ', '_', $categoryName));

                    DB::table('permissions')->insert([
                        'name' => $permissionName,
                        'permission_category_id' => $categoryId,
                    ]);
                }
            }
        }
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('permissions');
	}
};

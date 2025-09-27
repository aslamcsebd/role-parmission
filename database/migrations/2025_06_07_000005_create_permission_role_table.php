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
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            
			$table->primary(['permission_id', 'role_id']);
        });

		$roles = DB::table('roles')->pluck('id')->toArray();
		$permissions = DB::table('permissions')->pluck('id')->toArray();

		foreach ($roles as $roleId) {
			// Each role gets 5–10 random permissions
			$randomPermissions = (array)array_rand(array_flip($permissions), rand(5, 10));

			foreach ($randomPermissions as $permissionId) {
				DB::table('permission_role')->insert([
					'role_id' => $roleId,
					'permission_id' => $permissionId,
				]);
			}
		}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};

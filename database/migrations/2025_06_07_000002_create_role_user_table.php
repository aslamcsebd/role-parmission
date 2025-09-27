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
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
			$table->primary(['role_id', 'user_id']);
        });

		// $faker = Faker::create();

		// for ($i = 1; $i <= 30; $i++) {
		// 	DB::table('role_user')->insert([
		// 		'role_id' => rand(1, 30),
		// 		'user_id' => $faker->unique()->numberBetween(1, 30),
		// 	]);
        // }

		$userIds = DB::table('users')->pluck('id')->toArray();
        $roleIds = DB::table('roles')->pluck('id')->toArray();

        foreach ($userIds as $userId) {
            // Assign 1 random role to each user
            DB::table('role_user')->insert([
                'role_id' => $roleIds[array_rand($roleIds)],
                'user_id' => $userId,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};

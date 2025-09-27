<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

		$faker = Faker::create();

		for ($i = 1; $i <= 30; $i++) {
			DB::table('users')->insert([
				'name' => $i === 1 ? 'Admin' : $faker->name,
				'email' => $i === 1 ? 'admin@gmail.com' : $faker->unique()->safeEmail,
				'email_verified_at' => now(),
				'password' => Hash::make('123456'),
				'remember_token' => \Str::random(10),
				'created_at' => now(),
				'updated_at' => now(),
			]);
		}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
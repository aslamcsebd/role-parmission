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
        Schema::create('permission_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

		$faker = Faker::create();
		
        $categories = [
            'User Management',
            'Role Management',
            'Permission Management',
            'Settings',
            'Dashboard',
            'Reports',
            'Clients',
            'Projects',
            'Tasks',
            'Invoices',
            'Payments',
            'Products',
            'Orders',
            'Inventory',
            'Suppliers',
            'HR',
            'Employees',
            'Attendance',
            'Leaves',
            'Payroll',
            'Recruitment',
            'Support',
            'Tickets',
            'Knowledge Base',
            'Announcements',
            'Notifications',
            'Messaging',
            'Documents',
            'Audit Logs'
        ];

        foreach($categories as $category) {
            DB::table('permission_categories')->insert([
                'name' => $category,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_categories');
    }
};

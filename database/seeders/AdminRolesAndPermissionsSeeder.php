<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\PermissionCategory;
use Illuminate\Support\Facades\DB;

class AdminRolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $data = config('permissions');

        DB::transaction(function () use ($data) {

            // 1) Create or get admin role
            $adminRole = Role::firstOrCreate(['name' => 'admin']);

            // 2) Remove all categories and permissions related to config
            $categoryNames = array_keys($data['categories']);
            $normalizedCategoryNames = array_map(fn($n) => strtolower(preg_replace('/\s+/', '_', $n)), $categoryNames);

            $categories = PermissionCategory::whereIn('name', $normalizedCategoryNames)->get();

            foreach ($categories as $category) {
                // Delete all permissions in this category
                Permission::where('permission_category_id', $category->id)->delete();
                // Delete category
                $category->delete();
            }

            // 3) Insert categories + permissions from config
            foreach ($data['categories'] as $categoryName => $permissions) {
                $normalizedCategory = strtolower(preg_replace('/\s+/', '_', $categoryName));
                $category = PermissionCategory::create(['name' => $normalizedCategory]);

                foreach ($permissions as $perm) {
                    $normalizedPermission = strtolower(preg_replace('/\s+/', '_', $perm));
                    Permission::create([
                        'name' => $normalizedPermission,
                        'permission_category_id' => $category->id,
                    ]);
                }
            }

            // 4) Assign all inserted permissions to admin role
            $allPermissionIds = Permission::whereIn('permission_category_id', function ($query) use ($normalizedCategoryNames) {
                $query->select('id')->from('permission_categories')->whereIn('name', $normalizedCategoryNames);
            })->pluck('id')->toArray();

            $adminRole->permissions()->sync($allPermissionIds);

            // 5) Assign admin role to first user (id=1)
            $firstUser = User::find(1);
            if ($firstUser) {
                $firstUser->roles()->sync([$adminRole->id]);
            }

        }); // end transaction
    }
}

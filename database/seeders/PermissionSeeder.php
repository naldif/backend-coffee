<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'category-index'], ['name' => 'category-create'], ['name' => 'category-delete'], ['name' => 'category-update'],
            ['name' => 'coffeeshop-index'],['name' => 'coffeeshop-create'],  ['name' => 'coffeeshop-delete'], ['name' => 'supplier-update'],
            ['name' => 'menu-index'], ['name' => 'menu-create'], ['name' => 'menu-delete'], ['name' => 'menu-update'],
        ])->each(fn ($data) => Permission::create($data));
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Manager', 'description' => 'Full access to all features'],
            ['name' => 'Pharmacist', 'description' => 'Can dispense medicines and manage inventory'],
            ['name' => 'Stocker', 'description' => 'Can update inventory levels'],
            ['name' => 'Cashier', 'description' => 'Can process sales'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
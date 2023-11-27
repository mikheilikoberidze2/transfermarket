<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        {
            $superadmin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
            Role::create(['name' => 'Super Admin']);
            $superadmin->assignRole('Super Admin');



            $presidentRole = Role::create(['name' => 'president']);
            $managerRole = Role::create(['name' => 'manager']);

            $sendOffers = Permission::create(['name' => 'send-offers']);
            $receiveOffers = Permission::create(['name' => 'receive-offers']);

            $presidentRole->syncPermissions([$sendOffers]);
            $managerRole->syncPermissions([$receiveOffers]);

            $presidentUser = User::where('email', 'president@example.com')->first();

            if (!$presidentUser) {
                $presidentUser = User::create([
                    'name' => 'PresidentUser',
                    'email' => 'president@example.com',
                    'password' => bcrypt('password'),
                ]);
            }

            $presidentUser->assignRole('president');

            $managerUser = User::where('email', 'manager@example.com')->first();

            if (!$managerUser) {
                $managerUser = User::create([
                    'name' => 'ManagerUser',
                    'email' => 'manager@example.com',
                    'password' => bcrypt('password'),
                ]);
            }

            $managerUser->assignRole('manager');
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin account
        User::updateOrCreate(
            ['email' => 'admin@elite.ps'],
            [
                'name' => 'مدير إيليت',
                'password' => bcrypt('password'),
                'account_type' => 'admin',
                'phone' => '0599000000',
                'email_verified_at' => now(),
            ]
        );

        // Demo individual customer
        User::updateOrCreate(
            ['email' => 'customer@elite.ps'],
            [
                'name' => 'زبون تجريبي',
                'password' => bcrypt('password'),
                'account_type' => 'individual',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            TemplateSeeder::class,
            CategoryProductSeeder::class,
        ]);
    }
}

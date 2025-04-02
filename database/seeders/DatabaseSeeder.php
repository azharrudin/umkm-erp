<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Azhar Rudin',
            'email' => 'admin',
            "password" => "admin",
            "username" => "admin"
        ]);
        $faker = Faker::create();
        $sectors = ['Electronics', 'Automotive', 'Food', 'Textile', 'Construction'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('warehouse_suppliers')->insert([
                'name' => $faker->company,
                'contact' => $faker->phoneNumber,
                'sector' => $faker->randomElement($sectors),
                'address' => $faker->address,
                'notes' => $faker->sentence,
                'active' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Seed warehouse_branches
        $branches = [];
        for ($i = 1; $i <= 5; $i++) {
            $branches[] = [
                'name' => $faker->company,
                'maximum_capacity' => rand(500, 5000),
                'address' => $faker->address,
                'notes' => $faker->sentence,
                'active' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('warehouse_branches')->insert($branches);

        // Seed warehouse_modules
        $modules = [];
        for ($i = 1; $i <= 10; $i++) {
            $modules[] = [
                'item_code' => 'ITEM' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'item_stocking_unit' => 'pcs',
                'item_price' => rand(100, 1000) * 10,
                'item_since' => Carbon::now()->subDays(rand(30, 365)),
                'item_name' => $faker->word,
                'notes' => $faker->sentence,
                'supplier_id' => rand(1, 5), // Assume suppliers are seeded from 1 to 5
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('warehouse_modules')->insert($modules);

        // Seed warehouse_logs
        $logs = [];
        for ($i = 1; $i <= 50; $i++) {
            $logs[] = [
                'item_id' => rand(1, 10),
                'branch_id' => rand(1, 5),
                'tags' => Str::random(10),
                'actions' => ['added', 'removed', 'updated'][rand(0, 2)],
                'notes' => $faker->sentence,
                'quantity' => rand(1, 100),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('warehouse_logs')->insert($logs);
    }
}

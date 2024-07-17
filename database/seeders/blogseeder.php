<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class blogseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('blogs')->insert([
                'heading' => $faker->sentence,
                'body' => $faker->paragraph,
                'author' => $faker->name,
            ]);
        }

    }
}

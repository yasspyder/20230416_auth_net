<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category_name' => 'Культура'],
            ['category_name' => 'Наука'],
            ['category_name' => 'Спорт'],
            ['category_name' => 'Политика'],
            ['category_name' => 'Путешествия']
        ];
        foreach ($categories as $key) {
            DB::table('categories')->insert($key);
        }

        DB::table('news')->insert($this->getData());

        //DB::table('users')->insert($this->getUsers());
    }

    private function getData()
    {
        $faker = \Faker\Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'category_id' => rand(1, 5),
                'title' => $faker->sentence(3, 5),
                'text' => $faker->realText(100, 3),
                'is_private' => (bool)rand(0, 1)
            ];
        }
        return $data;
    }

    // private function getUsers()
    // {
    //     $faker = \Faker\Factory::create('ru_RU');
    //     $data = [];
    //     for ($i = 0; $i < 10; $i++) {
    //         $data[] = [
    //             'name' => fake()->name(),
    //             'email' => fake()->unique()->safeEmail(),
    //             'email_verified_at' => now(),
    //             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    //             'remember_token' => Str::random(10),
    //         ];
    //     }
    //     return $data;
    // }
}

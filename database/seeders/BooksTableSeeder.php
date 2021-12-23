<?php

namespace Database\Seeders;

use App\Models\Book;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1,10) as $i) {
            Book::query()->create([
                'title' => $faker->name,
                'year' => $faker->year,
                'number_of_pages' => $faker->numberBetween(2,100),
            ]);
        }
    }
}

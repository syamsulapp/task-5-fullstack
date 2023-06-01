<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;



class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        use App\Models\Articles;
        DB::table('Articles')->insert([
            'title' => => $this->faker->title(),
            'content' => => $this->faker->name(),
            'user_id'=> random_int(1,10),
            'category_id'=> random_int(1,10),
        ]);
    }
}

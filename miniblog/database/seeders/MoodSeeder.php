<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mood_weight;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mood = Mood_weight::create([

        'name' => 'Like',
        'weight' => 10,

        ]);

        $mood = Mood_weight::create([

        'name' => 'Click',
        'weight' => 5,

        ]);

    }
}

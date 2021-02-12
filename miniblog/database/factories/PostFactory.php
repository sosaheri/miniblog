<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text($maxNbChars = 15),
            'content' => $this->faker->text($maxNbChars = 250),
            'clicks' => $this->faker->numberBetween(1,20),
            'likes' => $this->faker->numberBetween(1,20),
            'mood' => $this->faker->numberBetween(1,20),
            'user_id' => $this->faker->numberBetween(1,10),

        ];

    }
}

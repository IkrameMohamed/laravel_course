<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title= $this->faker->realText($maxNbChars=50,$indexSize=2);

        return [
            //
            'title' => $title,
            'slug' =>Str::slug($title),
            'body' => $this->faker->text ,
            'image' =>$this->faker->imageUrl(680,480),
            'user_id'=>1,


        ];
    }

}

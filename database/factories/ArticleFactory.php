<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = $this->faker->sentence(6, true);

        return [
            'images' => $this->faker->image('/public/articles', 640, 480),
            'slug' => Str::of($sentence)->slug('-'),
            'title' => $sentence,
            'body' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'status' => $this->faker->randomElement($array = array ('enabled','disabled')),
            'keywords' => array('Diagnose'),
            'viewcount' => $this->faker->numberBetween(1, 20),
            'writer' => $this->faker->name($gender = null|'male'|'female'),
        ];
    }
}

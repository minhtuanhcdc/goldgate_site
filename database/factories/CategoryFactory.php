<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->text(30);
        return [
            //'name' => $this->faker->name(),
            //'name' => Str::random(10),
            //'slug' => Str::random(10),
            'name'=>$name,
            'slug' => Str::slug($name),
        ];
    }
}

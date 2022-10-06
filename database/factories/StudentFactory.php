<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Classes;
use App\Models\Section;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $class_id = rand(1,6);
        $section_id = Section::where('class_id',$class_id)->first();
        return [
            'name'=>$this->faker->name,
            'email'=>$this->faker->email,
            'phone_number'=>$this->faker->phoneNumber,
            'address'=>$this->faker->address,
            'class_id'=>$class_id,
            'section_id'=>$section_id,
        
        ];
    }
}

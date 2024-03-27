<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'price'=> random_int(1,1000),
            'thumbnail'=> "/img/product/product-".random_int(1,12).".jpg",
            'description'=> $this->faker->text(500),
            'qty'=>random_int(1,100),
            'category_id'=>random_int(1,10),
            'brand_id'=>random_int(1,100)
        ];
    }
}

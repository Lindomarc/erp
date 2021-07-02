<?php
	
	namespace Database\Factories;
	
	use App\Models\Category;
	use App\Models\Product;
	use App\Models\Unit;
	use Illuminate\Database\Eloquent\Factories\Factory;
	use Illuminate\Support\Str;
	
	class ProductFactory extends Factory
	{
		/**
		 * The name of the factory's corresponding model.
		 *
		 * @var string
		 */
		protected $model = Product::class;
		
		/**
		 * Define the model's default state.
		 *
		 * @return array
		 */
		public function definition()
		{
			$name = $this->faker->name();
			return [
				'name' => $name,
				'slug' => Str::slug($name),
				'product_code' => Str::random(10),
				'is_product' => rand(0,1),
				'is_material' => rand(0,1),
				'status' => rand(0,1),
				'price_buy' => $this->faker->randomFloat(3, 2, 10),
				'price_sale' => $this->faker->randomFloat(3, 2, 10),
				'category_id' => Category::factory(Category::class)->create()->id,
				'unit_id' => Unit::factory(Unit::class)->create()->id
			];
		}
	}

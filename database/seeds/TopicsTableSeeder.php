<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        // 所有用戶 ID 數組，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有分類 ID 數組，如：[1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        // 獲取 Faker 實例
        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
                        ->times(100)
                        ->make()
                        ->each(function ($topic, $index)
                            use ($user_ids, $category_ids, $faker)
        {
            // 從用戶 ID 數組中隨機取出一個並賦值
            $topic->user_id = $faker->randomElement($user_ids);

            // 話題分類，同上
            $topic->category_id = $faker->randomElement($category_ids);
        });

        // 將數據集合轉換為數組，並插入到數據庫中
        Topic::insert($topics->toArray());
    }
}

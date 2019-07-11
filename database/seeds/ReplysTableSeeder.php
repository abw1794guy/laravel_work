<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        // 所有用戶 ID 數組，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有話題 ID 數組，如：[1,2,3,4]
        $topic_ids = Topic::all()->pluck('id')->toArray();

        // 獲取 Faker 實例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
                        ->times(1000)
                        ->make()
                        ->each(function ($reply, $index)
                            use ($user_ids, $topic_ids, $faker)
        {
            // 從用戶 ID 數組中隨機取出一個並賦值
            $reply->user_id = $faker->randomElement($user_ids);

            // 話題 ID，同上
            $reply->topic_id = $faker->randomElement($topic_ids);
        });

        // 將數據集合轉換為數組，並插入到數據庫中
        Reply::insert($replys->toArray());
    }
}

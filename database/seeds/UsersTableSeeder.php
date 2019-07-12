<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 獲取 Faker 實例
        $faker = app(Faker\Generator::class);

        // 頭像假數據
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        // 生成數據集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
        {
            // 從頭像數組中隨機取出一個並賦值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 讓隱藏字段可見，並將數據集合轉換為數組
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到數據庫中
        User::insert($user_array);

        // 初始化用戶角色，將 1 號用戶指派為『站長』
        $user->assignRole('Founder');

        // 將 2 號用戶指派為『管理員』
        $user = User::find(2);
        $user->assignRole('Maintainer');

    }

}

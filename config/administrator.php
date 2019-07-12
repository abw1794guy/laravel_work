<?php

return array(

    // 後台的 URI 入口
    'uri' => 'admin',

    // 後台專屬域名，沒有的話可以留空
    'domain' => '',

    // 應用名稱，在頁面標題和左上角論壇名稱處顯示
    'title' => env('APP_NAME', 'Laravel'),

    // 模型配置信息文件存放目錄
    'model_config_path' => config_path('administrator'),

    // 配置信息文件存放目錄
    'settings_config_path' => config_path('administrator/settings'),

    /*
     * 後台菜單數組，多維數組渲染結果為多級嵌套菜單。
     *
     * 數組裏的值有三種類型：
     * 1. 字符串 —— 子菜單的入口，不可訪問；
     * 2. 模型配置文件 —— 訪問 `model_config_path` 目錄下的模型文件，如 `users` 訪問的是 `users.php` 模型配置文件；
     * 3. 配置信息 —— 必須使用前綴 `settings.`，對應 `settings_config_path` 目錄下的文件，如：默認設置下，
     *              `settings.site` 訪問的是 `administrator/settings/site.php` 文件
     * 4. 頁面文件 —— 必須使用前綴 `page.`，如：`page.pages.analytics` 對應 `administrator/pages/analytics.php`
     *               或者是 `administrator/pages/analytics.blade.php` ，兩種後綴名皆可
     *
     * 示例：
     *  [
     *      'users',
     *      'E-Commerce' => ['collections', 'products', 'product_images', 'orders'],
     *      'Settings'  => ['settings.site', 'settings.ecommerce', 'settings.social'],
     *      'Analytics' => ['E-Commerce' => 'page.pages.analytics'],
     *  ]
     */
     'menu' => [
        '用戶與權限' => [
            'users',
            'roles',
            'permissions',
        ],
        '內容管理' => [
            'categories',
            'topics',
            'replies',
        ],
        '論壇管理' => [
            'settings.site',
        ],
    ],

    /*
     * 權限控制的回調函數。
     *
     * 此回調函數需要返回 true 或 false ，用來檢測當前用戶是否有權限訪問後台。
     * `true` 為通過，`false` 會將頁面重定向到 `login_path` 選項定義的 URL 中。
     */
    'permission' => function () {
        // 只要是能管理內容的用戶，就允許訪問後台
        return Auth::check() && Auth::user()->can('manage_contents');
    },
    /*
     * 使用布爾值來設定是否使用後台主頁面。
     *
     * 如值為 `true`，將使用 `dashboard_view` 定義的視圖文件渲染頁面；
     * 如值為 `false`，將使用 `home_page` 定義的菜單條目來作為後台主頁。
     */
    'use_dashboard' => false,

    // 設置後台主頁視圖文件，由 `use_dashboard` 選項決定
    'dashboard_view' => '',

    // 用來作為後台主頁的菜單條目，由 `use_dashboard` 選項決定，菜單指的是 `menu` 選項
    'home_page' => 'topics',

    // 右上角『返回主站』按鈕的鏈接
    'back_to_site_path' => '/',

    // 當選項 `permission` 權限檢測不通過時，會重定向用戶到此處設置的路徑
    'login_path' => 'permission-denied',

    // 允許在登錄成功後使用 Session::get('redirect') 將用戶重定向到原本想要訪問的後台頁面
    'login_redirect_key' => 'redirect',

    // 控制模型數據列表頁默認的顯示條目
    'global_rows_per_page' => 20,

    // 可選的語言，如果不為空，將會在頁面頂部顯示『選擇語言』按鈕
    'locales' => [],
);

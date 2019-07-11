<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        // XSS 過濾
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成話題摘錄
        $topic->excerpt = make_excerpt($topic->body);

        // 如 slug 字段無內容，即使用翻譯器對 title 進行翻譯
        if ( ! $topic->slug) {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}

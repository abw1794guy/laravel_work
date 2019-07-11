<?php

namespace App\Observers;

use App\Notifications\TopicReplied;
use App\Models\Reply;
class ReplyObserver
{
    public function created(Reply $reply)
    {
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();

        // 通知話題作者有新的評論
        $reply->topic->user->notify(new TopicReplied($reply));
    }
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}

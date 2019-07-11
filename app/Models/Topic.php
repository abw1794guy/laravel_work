<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug'
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的數據讀取邏輯
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        // 預加載防止 N+1 問題
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 當話題有新回覆時，我們將編寫邏輯來更新話題模型的 reply_count 屬性，
        // 此時會自動觸發框架對數據模型 updated_at 時間戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照創建時間排序
        return $query->orderBy('created_at', 'desc');
    }
}

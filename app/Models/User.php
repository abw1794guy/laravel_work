<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Auth;
class User extends Authenticatable implements MustVerifyEmailContract
{

    use MustVerifyEmailTrait;

    use Notifiable {
        notify as protected laravelNotify;
    }
    public function notify($instance)
    {
        // 如果要通知的人是當前用戶，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有數據庫類型通知才需提醒，直接發送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }
     public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Presenters\DatePresenter;


class Comment extends Model
{
    use DatePresenter;


    protected $fillable = ['body', 'user_id', 'post_id','created_at'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

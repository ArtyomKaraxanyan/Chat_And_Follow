<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
class Post extends Model
{

    protected $fillable = [

        'title', 'text', 'image', 'user_id',
    ];


    public function updatePost($detals)
    {

            $post = $this->find($detals['id']);
            $post->id = $detals['id'];
            $post->title = $detals['title'];
            $post->text = $detals['text'];
            $post->avatar = $detals['avatar'];
            $post->save();
//        return 1;
        }


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

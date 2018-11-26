<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class NewPost extends Model
{

    protected $fillable = [
        'user_id', 'title', 'description'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
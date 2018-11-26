<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'activation_key', 'status', 'password' ,'provider', 'provider_id' ,'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function updateUser($detals)
    {
        $active='active';
        $user = $this->find($detals['id']);
        $user->id = auth()->user()->id;
        $user->name = $detals['name'];
        $user->status = $active;
        $user->mobile = $detals['mobile'];
        $user->B_day = $detals['B_day'];
        $user->save();
//        return 1;
    }

    public function updateUserPass($detals)
    {
        $user = $this->find($detals['id']);
        $user->password = Hash::make($detals['password']);
        $user->save();
//        return 1;
    }

    public function posts()
    {
        return $this->hasMany(NewPost::class);
    }
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
            ->withTimestamps();
    }
    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
            ->withTimestamps();
    }
    public function follow($userId)
    {
        $this->follows()->attach($userId);
        return $this;
    }
    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }
    public function isFollowing($userId)
    {
        return (boolean) $this->follows()->where('follows_id', $userId)->first(["users.id"]);
    }

}


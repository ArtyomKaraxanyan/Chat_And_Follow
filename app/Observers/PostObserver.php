<?php
namespace App\Observers;
use App\Notifications\NewPostNot;
use App\Post;
class PostObserver
{
    /**
     * Called whenever a post is created
     * @param Post $post
     */
    public function created(Post $post)
    {
        $user = $post->user;
        foreach ($user->followers as $follower) {
            $follower->notify(new NewPostNot($user, $post));
        }
    }
}
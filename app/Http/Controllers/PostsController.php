<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Image;

class PostsController extends Controller

{


    public function posts()
    {
       // $detals = Post::all();
        $users = User::all();
        $detals = Post::whereIn('user_id', auth()->user()->follows()->pluck('follows_id'))->get();

        return view('home', compact('detals', 'users'));
    }



    public function index()
    {
        $posts = Post::all();
        return view('posts', compact('posts'));

    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'text' => 'required|text|',
            'image' => 'required',

        ]);

    }

    public function create(Request $request)
    {
        $post = new \App\Post();

        if ($request->hasFile('avatar')) {


            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/posts/' . $filename));

            $post->title = $request->get('title');
            $post->text = $request->get('text');
            $post->avatar = $filename;
            $post->user_id = Auth::user()->id;
        }
        $post->save();
        return redirect('/home');

    }




    public function porofile_post()
    {
        $detals = Post::all();

        return view('profile', compact('detals'));
    }


    public function read_posts($id)
    {


        $pages = Post::find($id);
        $users = User::where('id,', 'user_id');

        return view('read_posts', compact('pages', 'users'));


    }

    public function deletePost($id)
    {

        $pages = Post::where('id', $id);
        $pages->delete();

        return redirect('/profile');

    }


    public function edit($id)
    {
        $post = Post::where('id',$id )
            ->where('id', $id)
            ->first();

        return view('edit_post', compact('post', 'id'));
    }

    public function post_update(Request $request, $id)
    {
        $post = new Post();

        if ($request->hasFile('avatar')) {


            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/posts/' . $filename));

            $data = $this->validate($request, [

                'title' => 'required',
                'text' => 'required',
                'avatar' => 'required',

            ]);
            $data['avatar'] = $filename;
        }

        $data['id'] = $id;
        $post->updatePost($data);

        return redirect('/profile');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}

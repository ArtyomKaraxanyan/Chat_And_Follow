<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\NewPost;
class NewPostsController extends Controller
{
    public function index()
    {
        $posts = NewPost::paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function show($id)
    {
        $post = NewPost::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required|max:255',
            'description'  => 'required|max:255'
        ]);
        NewPost::create([
            'title'     => $request->input('title'),
            'description' => $request->input('description'),
            'user_id'   => Auth::user()->id,
        ]);
        return redirect('/posts')->with('status', 'post was created successfully');
    }
    public function edit(NewPost $post)
    {
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title'       => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $post->update($request->all());
        return back()->with('success', 'Post info updated successfully.');
    }
    public function destroy(NewPost $post)
    {
        $post->delete();
        return redirect('/posts')->with('success', 'Post was deleted');
    }
}
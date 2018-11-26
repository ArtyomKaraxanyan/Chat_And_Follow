<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Input;
use Auth;
use Image;
use Validator;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

//    public function index()
//    {
//
//        $users = User::where('id', auth()->user()->id)->get();
//
//       return view('home',compact('users')) ;
//
//
//    }


    public function read($id) {

        $pages=Post::all();
        $details = User::find($id);

        return view('pages',compact('details','id','pages'));

    }

    public function edit($id)
{
    $user = User::where('id', auth()->user()->id)
        ->where('id', $id)
        ->first();

    return view('edit', compact('user', 'id'));
}

    public function update(Request $request, $id)
    {
        $user = new User();
        if(Auth::user()->password === null) {

            $data = $this->validate($request, [

                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'B_day' => 'required',



            ]);
        } else{

            $data = $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'B_day' => 'required',

            ]);
        }
        $data['id']=$id;
        $user->updateUser($data);

        return redirect('/profile');
    }

    public function profile(){

        return view('profile', array('user') );
    }

    public function update_avatar(Request $request){

        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            if(Auth::user()->provider){

                Image::make($avatar)->resize(300, 300)->save( public_path( $filename ) );


            }else{

                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

            }
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return view('profile', array('user' => Auth::user()) );

    }

    public function editpass($id)
    {
        $user = User::where('id', auth()->user()->id)
            ->where('id', $id)
            ->first();

        return view('editpass', compact('user', 'id'));
    }

    public function updatepass(Request $request, $id)
    {
        $user = new User();
        $data = $this->validate($request, [
                'password' => 'required'
            ]);

        $data['id']=$id;

        $user->updateUserPass($data);

            $user->password =$data['password'];

            return redirect('/profile');

    }


    public function posts()
    {

        $users = User::all();

        return view ('home',compact('users'));


    }


    public function delete($id){


        $user =User::where('id', $id);
        $user->delete();
       return redirect('/login');
    }


public function search (){
    $q = Input::get ( 'q' );

    $user = \App\User::where('name','LIKE','%'.$q.'%')->get();
    if (empty($q)) {
        return view ('search')->withMessage('No Details found. Try to search again !');
        exit();
    }else
        if(count($user) > 0)

            return view('search')->withDetails($user)->withQuery ( $q );
        else return view ('search')->withMessage('No Details found. Try to search again !');


}


}

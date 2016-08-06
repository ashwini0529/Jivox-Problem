<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /*
     *  function to see all users registered
     * */

    public function showAllUsers()
    {
        $users = User::all();
        $userId = Auth::user()->id;
        $following = Auth::user()->followers;
        $followingIds = array();
        foreach ($following as $individual)
        {
            array_push($followingIds, $individual->id);
        }
        
        return view('showAllUsers',compact('users','userId','followingIds'));
    }

    /*
     * A function to follow all other users
     * */

    public function followUser(Request $request)
    {
        $follow = new Follower();
        $follow->user_id = $request->user_id;
        $follow->following_id  = $request->following_id;
        $follow->save();
        return back();
    }
    
    /*
     * function to show the chain of following users.
     * */
    
    public function showFollowing()
    {
        $user = Auth::user();
        $array = array();
        $following = $user->followers;
        foreach ($following as $individual)
        {
            /*
             * Eloquent relationship
             * Model->User
             * */
           $individual = User::where('id',$individual->user_id)->first();
            $follow = $individual->followers;
            $array = array_add($array, $individual->id, $follow);



        }
        return $array;
    }
}

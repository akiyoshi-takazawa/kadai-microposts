<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; //追加
use App\Microposts; // 追加

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id' , 'desc')->paginate(10);
        
        return view('users.index',[
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }
    // getでusers/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    //　user情報更新処理
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);
        
        $user = User::find($id);
        $user->name = $request->name;    
        $user->save();

        return back();
    }
    
    // 「削除処理」
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/');
    }
    
    // フォロー機能　
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $microposts = $user->favorites()->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.favorites', $data);
    }
    
    
}



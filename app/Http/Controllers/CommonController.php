<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
	function index() {
		$user_rs =  Auth::user();

		$comments = Comment::all();
		$comments = Comment::latest()->get();

		return view('common.index',['user_rs'=>$user_rs, 'comments'=>$comments]);
	}

	function addcommon(Request $request) {
		$user_rs =  Auth::user();
		$comment = Comment::create([
			'user_id'     => $user_rs->id,
			'user_name'	  => $user_rs->name,
			'content'	  => $request->input('content')
    	]);
		return redirect()->route('home')->with('success', '新增成功');
	}
}

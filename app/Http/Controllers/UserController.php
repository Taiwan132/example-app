<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
		
		if (Auth::check()){
			$name = Auth::user()->name;
			return redirect()->route('home')->with('success', '歡迎回來，'.$name.'！');
		}
		return view('user.login');
	}

	public function login(Request $request) {
		// 1. 驗證資料
       $credentials = $request->validate([
			'email'    => 'required|email',
			'password' => 'required', // 登入通常不限制 min:8，因為只要跟資料庫一致就好
		]);
		
		if (Auth::attempt($credentials)) {
        // 登入成功，重新產生 Session 防止攻擊
			$name = Auth::user()->name;
			$request->session()->regenerate();
			return redirect()->route('home')->with('success', '歡迎回來，'.$name.'！');
		}

	}

	public function sign(Request $request) {
		// 1. 驗證資料
       $validated = $request->validate([
			'name'     => 'required|string|max:255',
			'email'    => 'required|email|unique:users,email',
			// 關鍵：加上 confirmed 規則
			'password' => 'required|min:8|confirmed', 
		], [
			// 自定義中文錯誤訊息（展現你的細心）
			'password.confirmed' => '兩次輸入的密碼不一致，請再檢查一下。',
			'password.min'       => '密碼至少要 8 個字。',
		]);

		
		$exists = User::where('email', $request->email)->exists();
		if ($exists) {
			return back()->withErrors(['email' => 'Email 已經被註冊過了！']);
		}

		$user = User::create([
			'name'     => $validated['name'],
			'email'    => $validated['email'],
			'password' => Hash::make($validated['password']), 
    	]);

		return redirect()->route('login')->with('success', '註冊成功，請登入。');
	}

	function logout(Request $request) {
		// 1. 執行登出
        Auth::logout();

        // 2. 讓目前的 Session 失效（清除所有 Session 資料）
        $request->session()->invalidate();

        // 3. 重新產生 CSRF Token，防止 Session 固定攻擊
        $request->session()->regenerateToken();

        // 4. 重導向至首頁
        return redirect()->route('login')->with('success', '您已成功登出！');
	}
}

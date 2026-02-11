<form action="{{ route('sign.post') }}" method="POST">
    @csrf 
    <h2>註冊帳號</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label>使用者名稱:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label>密碼:</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>確認密碼:</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <div style="margin-top: 10px;">
        <button type="submit">註冊</button>
        
        <a href="{{ route('login') }}" style="text-decoration: none; margin-left: 10px;">
            <button type="button">已有帳號？返回登入</button>
        </a>
    </div>
</form>
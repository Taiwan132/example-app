<form action="{{ route('login.post') }}" method="POST">
    @csrf <h2>登入系統</h2>

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
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label>密碼:</label>
        <input type="password" name="password" required>
    </div>

    <div style="margin-top: 10px;">
        <button type="submit">登入</button>
        
        <a href="{{ route('register') }}" style="text-decoration: none; margin-left: 10px;">
            <button type="button">前往註冊</button>
        </a>
    </div>
</form>
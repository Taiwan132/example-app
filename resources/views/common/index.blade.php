<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>評論樣板 - 明亮</title>
    <style>
        /* 基本重置 */
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft JhengHei", sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            line-height: 1.6;
        }

        /* 導航列 */
        .header {
            background: #ffffff;
            padding: 0 20px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }
        .logo { font-size: 1.25rem; font-weight: bold; color: #1877f2; }
        .user-nav { display: flex; align-items: center; gap: 15px; }
        .logout-link { color: #65676b; text-decoration: none; font-size: 14px; }
        .logout-link:hover { text-decoration: underline; }

        /* 主容器 */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* 發表評論區 */
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card-title { margin: 0 0 15px 0; font-size: 18px; color: #1c1e21; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px; }
        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box;
            background-color: #f5f6f7;
        }
        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 15px;
            min-height: 100px;
            resize: vertical;
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: #1877f2;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .btn-submit:hover { background-color: #166fe5; }

        /* 評論展示區 */
        .comment-item {
            background: white;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        .comment-user { font-weight: bold; color: #050505; font-size: 15px; }
        .comment-date { font-size: 12px; color: #65676b; margin-top: 2px; }
        .comment-content { margin-top: 10px; color: #050505; font-size: 15px; }

    </style>
</head>
<body>

    <header class="header">
        <div class="logo">明亮的專案</div>
        <div class="user-nav">
            <span class="username"><strong>{{$user_rs->name}}</strong></span>
            <a href="{{ route('logout') }}" class="logout-link">登出</a>
        </div>
    </header>

    <div class="container">
        
        <section class="card">
            <h3 class="card-title">發表新評論</h3>
            <form action="{{ route('common_insert') }}" method="POST">
				@csrf 
                <div class="form-group">
                    <label>當前使用者</label>
                    <input type="text" class="form-input" value="明亮" readonly>
                </div>
                <div class="form-group">
                    <label>評論內容</label>
                    <textarea name="content" class="form-textarea" placeholder="在此輸入您的想法..."></textarea>
                </div>
                <button type="submit" class="btn-submit">發布評論</button>
            </form>
        </section>

        <section>
            <h3 class="card-title">最新評論</h3>
			@foreach ($comments as $comment)
            <div class="comment-item">
                <div class="comment-user">{{$comment->user_name}}</div>
                <div class="comment-date">{{$comment->created_at}}</div>
                <div class="comment-content">{{$comment->content}}</div>
            </div>
			@endforeach
           
        </section>

    </div>

</body>
</html>
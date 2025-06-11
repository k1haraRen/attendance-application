<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #fff;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 16px;
        }

        .logo {
            font-weight: bold;
            font-size: 20px;
        }

        .container {
            max-width: 400px;
            margin: 40px auto;
            text-align: center;
        }

        h2 {
            margin-bottom: 24px;
            font-size: 24px;
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        .login-link {
            margin-top: 16px;
            text-align: center;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    {{-- 共通ヘッダー読み込み --}}
    @include('layouts.app')

    <div class="container">
        <h2>会員登録</h2>
        {{-- <form method="POST" action="{{ route('register') }}"> --}}
            @csrf

            <label for="name">名前</label>
            <input type="text" name="name" id="name" required>

            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required>

            <label for="password">パスワード</label>
            <input type="text" name="password" id="password" required>

            <label for="password_confirmation">パスワード確認</label>
            <input type="text" name="password_confirmation" id="password_confirmation" required>

            <button type="submit" class="submit-btn">登録する</button>
        </form>

        <div class="login-link">
            <a href=>ログインはこちら</a>
        </div>
    </div>

</body>

</html>
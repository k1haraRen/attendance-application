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
        <h2>管理者ログイン</h2>
        {{-- <form method="POST" action="{{ route('login') }}"> --}}
            @csrf
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required>

            <label for="password">パスワード</label>
            <input type="text" name="password" id="password" required>

            <button type="submit" class="submit-btn">管理者ログインする</button>
        </form>
    </div>

</body>

</html>
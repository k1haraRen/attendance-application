<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', '勤怠管理システム')</title>
</head>

<body style="font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f0f2;">
    <header
        style="background-color: #000; padding: 16px; display: flex; justify-content: space-between; align-items: center; height: 3vh;">
        <div class="logo">
            <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" style="height: 24px;">
        </div>

        @auth
            <nav class="nav-links">
                <a href="{{ route('manager.admin') }}" style="color: #fff; margin-left: 16px; text-decoration: none;">勤怠一覧</a>
                <a href="{{ route('staff.list') }}"
                    style="color: #fff; margin-left: 16px; text-decoration: none;">スタッフ一覧</a>
                <a href="{{ route('request.list') }}" style="color: #fff; margin-left: 16px; text-decoration: none;">申請一覧</a>
                <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    style="color: #fff; margin-left: 16px; text-decoration: none;">
                    ログアウト
                </a>

                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        @endauth
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
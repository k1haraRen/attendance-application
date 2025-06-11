<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', '勤怠管理システム')</title>
</head>
<body style="font-family: Arial, sans-serif;
            margin: 0;
            background-color: #fff;">
<header style="background-color: #000; padding: 16px; display: flex; justify-content: space-between; align-items: center; height: 3vh;">
    <div class="logo">
        {{-- ロゴ画像 --}}
        <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" style="height: 24px;">
    </div>

    {{-- ログインしているユーザー向けナビ --}}
    @auth
        <nav class="nav-links">
            <a href="{{ route('attendance.index') }}" style="color: #fff; margin-left: 16px; text-decoration: none;">勤怠</a>
            <a href="{{ route('attendance.list') }}" style="color: #fff; margin-left: 16px; text-decoration: none;">勤怠一覧</a>
            <a href="{{ route('application.index') }}" style="color: #fff; margin-left: 16px; text-decoration: none;">申請</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                style="color: #fff; margin-left: 16px; text-decoration: none;">
                ログアウト
            </a>

            {{-- logout用フォーム --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
{{-- 勤怠画面 --}}
@extends('layouts.app')

@section('content')
    <div style="text-align: center; padding: 48px 16px; background-color: #f5f5f5; height: 100vh;">
        @if ($status === 'none')
            <div
                style="background: #ccc; color: #fff; padding: 4px 12px; border-radius: 12px; display: inline-block; font-size: 12px; margin-bottom: 16px;">
                勤務外</div>
        @elseif ($status === 'working')
            <div
                style="background: #4CAF50; color: #fff; padding: 4px 12px; border-radius: 12px; display: inline-block; font-size: 12px; margin-bottom: 16px;">
                勤務中</div>
        @elseif ($status === 'resting')
            <div
                style="background: #FFA500; color: #fff; padding: 4px 12px; border-radius: 12px; display: inline-block; font-size: 12px; margin-bottom: 16px;">
                休憩中</div>
        @endif

        {{-- 日付と時間 --}}
        <div id="current-date" style="font-size: 18px; margin-bottom: 8px;"></div>
        <div id="current-time" style="font-size: 40px; font-weight: bold; margin-bottom: 24px;"></div>

        {{-- ボタン --}}
        @if ($status === 'none')
            <form method="POST" action="{{ route('attendance.start') }}">
                @csrf
                <button type="submit" style="background: #000; color: #fff; padding: 10px 32px; border-radius: 6px;">出勤</button>
            </form>
        @elseif ($status === 'working')
        {{-- 休憩がまだ or 1回目済みかつ2回目未開始なら表示 --}}
            @if ($attendance && (!$attendance->rests1 || ($attendance->rests1 && $attendance->reste1 && !$attendance->rests2)))
                <form method="POST" action="{{ route('attendance.break') }}" style="display: inline-block; margin-right: 10px;">
                    @csrf
                    <button style="background: #888; color: #fff; padding: 10px 20px; border-radius: 6px;">休憩</button>
                </form>
            @endif
            <form method="POST" action="{{ route('attendance.end') }}" style="display: inline-block;">
                @csrf
                <button style="background: #000; color: #fff; padding: 10px 20px; border-radius: 6px;">退勤</button>
            </form>
        @elseif ($status === 'resting')
            <form method="POST" action="{{ route('attendance.resume') }}">
                @csrf
                <button style="background: #000; color: #fff; padding: 10px 32px; border-radius: 6px;">休憩戻り</button>
            </form>
        @elseif ($status === 'finished')
            <div style="font-size: 18px; color: #333; margin-top: 24px;">
                お疲れさまでした。
            </div>
        @endif
    </div>

    {{-- JS: 日付と時刻のリアルタイム更新 --}}
    <script>
        function updateTime() {
            const now = new Date();
            const days = ['日', '月', '火', '水', '木', '金', '土'];
            const formattedDate = now.getFullYear() + '年' + (now.getMonth() + 1) + '月' + now.getDate() + '日(' + days[now.getDay()] + ')';
            const formattedTime = now.toTimeString().slice(0, 5);
            document.getElementById('current-date').textContent = formattedDate;
            document.getElementById('current-time').textContent = formattedTime;
        }

        updateTime();
        setInterval(updateTime, 1000);
    </script>
@endsection
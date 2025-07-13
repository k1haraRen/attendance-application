@extends('layouts.app')
<style>
td {
    border-bottom: 2px solid #f0f0f2;
    padding-top: 30px;
    padding-bottom: 30px;
}
</style>

@section('content')
    <div class="container"
        style="display: flex; flex-direction: column; justify-content: center; padding-left: 25%;">
            <h2 style="width; 70%; font-weight: bold; border-left: 5px solid #000; padding-left: 10px; margin-bottom: 30px;">勤怠詳細</h2>
            <form method="POST" action="{{ route('corrections.store') }}">
                @csrf
                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">

                <table style="width: 70%; background: #fff; border-radius: 5px;">
                    <tr>
                        <td style="width: 30%; padding-left: 50px; font-weight: bold;">名前</td>
                        <td style="padding-left: 50px;">{{ $attendance->user->name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding-left: 50px;">日付</td>
                        <td style="padding-left: 50px;">
                            {{ \Carbon\Carbon::parse($attendance->date)->format('Y年m月d日') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding-left: 50px;">出勤・退勤</td>
                        <td style="padding-left: 50px;">
                            <input type="time" name="start_time"
                                value="{{ old('start_time', optional($attendance->syukkin)->format('H:i')) }}">
                            〜
                            <input type="time" name="end_time"
                                value="{{ old('end_time', optional($attendance->taikin)->format('H:i')) }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding-left: 50px;">休憩</td>
                        <td style="padding-left: 50px;">
                            <input type="time" name="break_start"
                                value="{{ old('break_start', optional($attendance->rests1)->format('H:i')) }}">
                            〜
                            <input type="time" name="break_end"
                                value="{{ old('break_end', optional($attendance->reste1)->format('H:i')) }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding-left: 50px;">休憩2</td>
                        <td style="padding-left: 50px;">
                            <input type="time" name="break2_start"
                                value="{{ old('break2_start', optional($attendance->rests2)->format('H:i')) }}">
                            〜
                            <input type="time" name="break2_end"
                                value="{{ old('break2_end', optional($attendance->reste2)->format('H:i')) }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding-left: 50px;">備考</td>
                        <td style="padding-left: 50px;">
                            <textarea name="remarks" rows="4" style="width: 50%;">{{ old('remarks') }}</textarea>
                        </td>
                    </tr>
                </table>

                @if ($hasPendingCorrection)
                    <div style="width: 70%; text-align: center; margin: 30px auto; color: red; font-weight: bold;">
                        承認待ちのため修正できません。
                    </div>
                @else
                    <form method="POST" action="{{ route('corrections.store') }}">
                        @csrf
                        <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                        <div style="width: 70%; text-align: right; margin-top: 30px;">
                            <button
                                style="padding: 10px 30px; background-color: black; color: white; border: none; font-weight: bold; border-radius: 5px;">
                                修正
                            </button>
                        </div>
                    </form>
                @endif
            </form>
    </div>
    @if ($errors->any())
        <div
            style="width: 70%; margin: 0 auto; margin-bottom: 20px; background-color: #ffe6e6; border: 1px solid red; border-radius: 5px; padding: 15px; color: red;">
            <strong>入力内容に誤りがあります：</strong>
            <ul style="margin-top: 10px;">
                @foreach ($errors->all() as $error)
                    <li>・{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
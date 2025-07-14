@extends('layouts.app_admin')
<style>
    td {
        border-bottom: 2px solid #f0f0f2;
        padding-top: 30px;
        padding-bottom: 30px;
    }
</style>

@section('content')
    <div class="container" style="display: flex; flex-direction: column; justify-content: center; padding-left: 25%;">
        <h2 style="width; 70%; font-weight: bold; border-left: 5px solid #000; padding-left: 10px; margin-bottom: 30px;">
            勤怠詳細</h2>

        <form method="POST" action="{{ route('admin.corrections.approve', $correction->id) }}">
            @csrf
            @php
                $attendance = $correction->attendance;
                $readonly = $correction->status === 'approved' ? 'readonly' : '';
            @endphp

            <table style="width: 70%; background: #fff; border-radius: 5px;">
                <tr>
                    <td style="padding-left: 50px; font-weight: bold;">名前</td>
                    <td style="padding-left: 50px;">{{ $attendance->user->name }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 50px; font-weight: bold;">日付</td>
                    <td style="padding-left: 50px;">{{ \Carbon\Carbon::parse($attendance->date)->format('Y年m月d日') }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 50px; font-weight: bold;">出勤・退勤</td>
                    <td style="padding-left: 50px;">
                        <input type="time" name="start_time" value="{{ $correction->start_time }}" {{ $readonly }}>
                        〜
                        <input type="time" name="end_time" value="{{ $correction->end_time }}" {{ $readonly }}>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 50px; font-weight: bold;">休憩</td>
                    <td style="padding-left: 50px;">
                        <input type="time" name="break_start" value="{{ $correction->break_start }}" {{ $readonly }}>
                        〜
                        <input type="time" name="break_end" value="{{ $correction->break_end }}" {{ $readonly }}>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 50px; font-weight: bold;">休憩2</td>
                    <td style="padding-left: 50px;">
                        <input type="time" name="break2_start" value="{{ $correction->break2_start }}" {{ $readonly }}>
                        〜
                        <input type="time" name="break2_end" value="{{ $correction->break2_end }}" {{ $readonly }}>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 50px; font-weight: bold;">備考</td>
                    <td style="padding-left: 50px;">
                        <textarea name="remarks" rows="4" style="width: 50%;" {{ $readonly }}>{{ $correction->remarks }}</textarea>
                    </td>
                </tr>
            </table>

            <div style="width: 70%; text-align: right; margin-top: 30px;">
                @if ($correction->status === 'approved')
                    <button disabled
                        style="padding: 10px 30px; background-color: gray; color: white; border: none; font-weight: bold; border-radius: 5px;">
                        承認済み
                    </button>
                @else
                    <button
                        style="padding: 10px 30px; background-color: black; color: white; border: none; font-weight: bold; border-radius: 5px;">
                        承認
                    </button>
                @endif
            </div>
        </form>
    </div>
@endsection
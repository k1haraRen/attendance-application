@extends('layouts.app_admin')

@section('content')
    <div class="container" style="text-align:center; padding: 40px 0;">
        <h2
            style="text-align: left; font-weight: bold; margin-left: 15%; margin-bottom: 20px; padding-left: 1%; border-left: 5px solid black;">
            {{ $date->format('Y月m日d') }}の勤怠</h2>

        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="month-selector"
                style="display: flex; justify-content: space-between; align-items: center; width: 70vw; gap: 20px; margin-bottom: 30px; background-color: white; border-radius: 5px;">
                <a href="{{ route('manager.admin', ['date' => $prevDate]) }}" style="font-weight: bold;">← 前日</a>
                <div style="font-weight: bold;">📅 {{ $date->format('Y/m/d') }}</div>
                <a href="{{ route('manager.admin', ['date' => $nextDate]) }}" style="font-weight: bold;">翌日 →</a>
            </div>
        </div>

        <table
            style="margin: 0 auto; width: 70%; border-collapse: collapse; border: 2px solid #00f; border-radius: 8px; overflow: hidden; background-color: white;">
            <thead style="background-color: #f5f5f5;">
                <tr>
                    <th style="padding: 10px;">名前</th>
                    <th style="padding: 10px;">出勤</th>
                    <th style="padding: 10px;">退勤</th>
                    <th style="padding: 10px;">休憩</th>
                    <th style="padding: 10px;">合計</th>
                    <th style="padding: 10px;">詳細</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr style="border-top: 1px solid #ccc;">
                        <td style="padding: 10px;">{{ $attendance->user->name }}</td>
                        <td>{{ optional($attendance->syukkin)->format('H:i') }}</td>
                        <td>{{ optional($attendance->taikin)->format('H:i') }}</td>
                        <td>
                            @php
    $rest1 = $attendance->rests1 && $attendance->reste1 ? strtotime($attendance->reste1) - strtotime($attendance->rests1) : 0;
    $rest2 = $attendance->rests2 && $attendance->reste2 ? strtotime($attendance->reste2) - strtotime($attendance->rests2) : 0;
    $totalRest = $rest1 + $rest2;
                            @endphp
                            {{ gmdate('H:i', $totalRest) }}
                        </td>
                        <td>
                            @php
    $start = $attendance->syukkin;
    $end = $attendance->taikin;
    $workSeconds = $start && $end ? strtotime($end) - strtotime($start) - $totalRest : 0;
                            @endphp
                            {{ gmdate('H:i', $workSeconds) }}
                        </td>
                        <td>
                            <a href="{{ route('apply.approve', ['id' => $attendance->id]) }}"
                                style="color: black; font-weight: bold;">詳細</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 10px;">この日の勤怠データはありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
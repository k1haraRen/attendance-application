@extends('layouts.app')

@section('content')
    <div class="container" style="text-align:center; padding: 40px 0;">
        <h2 style="text-align: left; font-weight: bold; margin-left: 15%; margin-bottom: 20px; padding-left: 1%; border-left: 5px solid black;">勤怠一覧</h2>

        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="month-selector"
                style="display: flex; justify-content: space-between; align-items: center; width: 70vw; gap: 20px; margin-bottom: 30px; background-color: white; border-radius: 5px;">
                <a href="{{ route('attendance.list', ['month' => $prevMonth]) }}"
                    style="text-decoration: none; font-weight: bold;">← 前月</a>
                <div style="font-weight: bold;">📅 {{ $monthLabel }}</div>
                <a href="{{ route('attendance.list', ['month' => $nextMonth]) }}"
                    style="text-decoration: none; font-weight: bold;">翌月 →</a>
            </div>
        </div>

        <table
            style="margin: 0 auto; width: 70%; border-collapse: collapse; border: 2px solid #00f; border-radius: 8px; overflow: hidden; background-color: white;">
            <thead style="background-color: #f5f5f5;">
                <tr>
                    <th style="padding: 10px;">日付</th>
                    <th style="padding: 10px;">出勤</th>
                    <th style="padding: 10px;">退勤</th>
                    <th style="padding: 10px;">休憩</th>
                    <th style="padding: 10px;">合計</th>
                    <th style="padding: 10px;">詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    @php
                        $date = \Carbon\Carbon::parse($attendance->date);
                        $restMinutes = 0;
                        if ($attendance->rests1 && $attendance->reste1) {
                            $restMinutes += \Carbon\Carbon::parse($attendance->reste1)->diffInMinutes(\Carbon\Carbon::parse($attendance->rests1));
                        }
                        if ($attendance->rests2 && $attendance->reste2) {
                            $restMinutes += \Carbon\Carbon::parse($attendance->reste2)->diffInMinutes(\Carbon\Carbon::parse($attendance->rests2));
                        }
                        $totalMinutes = 0;
                        if ($attendance->syukkin && $attendance->taikin) {
                            $totalMinutes = \Carbon\Carbon::parse($attendance->taikin)->diffInMinutes(\Carbon\Carbon::parse($attendance->syukkin)) - $restMinutes;
                        }
                    @endphp
                    <tr style="border-top: 1px solid #ccc;">
                        <td style="padding: 10px;">{{ $date->format('m/d') }}({{ ['日', '月', '火', '水', '木', '金', '土'][$date->dayOfWeek] }})
                        </td>
                        <td>{{ $attendance->syukkin ? \Carbon\Carbon::parse($attendance->syukkin)->format('H:i') : '' }}</td>
                        <td>{{ $attendance->taikin ? \Carbon\Carbon::parse($attendance->taikin)->format('H:i') : '' }}</td>
                        <td>{{ floor($restMinutes / 60) }}:{{ str_pad($restMinutes % 60, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ floor($totalMinutes / 60) }}:{{ str_pad($totalMinutes % 60, 2, '0', STR_PAD_LEFT) }}</td>
                        <td><a href="{{ route('attendance.edit', ['id' => $attendance->id]) }}"
                                style="color: black; font-weight: bold;">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
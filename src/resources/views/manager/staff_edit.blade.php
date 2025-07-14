@php
$prev = $currentMonth->copy()->subMonth();
$next = $currentMonth->copy()->addMonth();
$weekDays = ['日', '月', '火', '水', '木', '金', '土'];
@endphp
@extends('layouts.app_admin')

@section('content')
    <div class="container" style="text-align:center; padding: 40px 0;">
        <h2
            style="text-align: left; font-weight: bold; margin-left: 15%; margin-bottom: 20px; padding-left: 1%; border-left: 5px solid black;">
            {{ $user->name }}さんの勤怠</h2>

        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="month-selector" style="display: flex; justify-content: space-between; align-items: center; width: 70vw; gap: 20px; margin-bottom: 30px; background-color: white; border-radius: 5px;">
                <a href="{{ route('staff.edit', ['id' => $user->id, 'year' => $prev->year, 'month' => $prev->month]) }}"
                style="text-decoration: none; font-weight: bold;">← 前月</a>

                <div style="font-weight: bold;">
                    📅 {{ $currentMonth->format('Y/m') }}
                </div>

                <a href="{{ route('staff.edit', ['id' => $user->id, 'year' => $next->year, 'month' => $next->month]) }}"
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
                                    <tr style="border-top: 1px solid #ccc;">
                                        <td style="padding: 10px;">
                                        {{ \Carbon\Carbon::parse($attendance->date)->format('m/d') }}
                                        ({{ $weekDays[\Carbon\Carbon::parse($attendance->date)->dayOfWeek] }})
                                        </td>
                                        <td>{{ optional($attendance->syukkin)->format('H:i') ?? '--:--' }}</td>
                                        <td>{{ optional($attendance->taikin)->format('H:i') ?? '--:--' }}</td>
                                        <td>
                                            @php
                    $break = 0;
                    if ($attendance->rests1 && $attendance->reste1) {
                        $break += \Carbon\Carbon::parse($attendance->rests1)->diffInMinutes($attendance->reste1);
                    }
                    if ($attendance->rests2 && $attendance->reste2) {
                        $break += \Carbon\Carbon::parse($attendance->rests2)->diffInMinutes($attendance->reste2);
                    }
                                            @endphp
                                            {{ floor($break / 60) }}:{{ str_pad($break % 60, 2, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td>
                                            @if ($attendance->syukkin && $attendance->taikin)
                                                @php
                        $workMinutes = \Carbon\Carbon::parse($attendance->syukkin)->diffInMinutes($attendance->taikin) - $break;
                                                @endphp
                                                {{ floor($workMinutes / 60) }}:{{ str_pad($workMinutes % 60, 2, '0', STR_PAD_LEFT) }}
                                            @else
                                                --:--
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('apply.approve', ['id' => $attendance->id]) }}"
                                                style="color: black; font-weight: bold;">詳細</a>
                                        </td>
                                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
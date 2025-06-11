@extends('layouts.app')

@section('content')
    <div class="container" style="width: 80%; margin: 0 auto;">
        <h2 style="text-align: center; margin: 30px 0;">勤怠一覧</h2>

        <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
            <a href="#" style="margin-right: 20px; text-decoration: none;">＜ 前月</a>
            <span style="font-weight: bold;">2023年6月</span>
            <a href="#" style="margin-left: 20px; text-decoration: none;">次月 ＞</a>
        </div>

        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f0f0f0;">
                    <th style="padding: 10px; border: 1px solid #ccc;">日付</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">出勤時間</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">退勤時間</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">休憩時間</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">勤務時間</th>
                </tr>
            </thead>
            <tbody>
                {{-- 後ほど@foreachで繰り返し処理を設定 --}}
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">2023/06/01</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">08:00</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">17:00</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">01:00</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">08:00</td>
                </tr>
                <!-- 他の勤怠データも同様に表示 -->
            </tbody>
        </table>
    </div>
@endsection
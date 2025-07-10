@extends('layouts.app')

@section('content')
    <div class="container" style="text-align:center; padding: 40px 0;">
        <h2
            style="text-align: left; font-weight: bold; margin-left: 15%; margin-bottom: 20px; padding-left: 1%; border-left: 5px solid black;">
            2023年6月1日の勤怠</h2>

        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="month-selector"
                style="display: flex; justify-content: space-between; align-items: center; width: 70vw; gap: 20px; margin-bottom: 30px; background-color: white; border-radius: 5px;">
                <button style="border: none; background: none; font-weight: bold;">← 前月</button>
                <div style="font-weight: bold;">📅 2023/06</div>
                <button style="border: none; background: none; font-weight: bold;">翌月 →</button>
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
                {{-- 以下、後ほどforeachで置き換えてください --}}
                @for ($i = 1; $i <= 30; $i++)
                    <tr style="border-top: 1px solid #ccc;">
                        <td style="padding: 10px;">山田　太郎</td>
                        <td>09:00</td>
                        <td>18:00</td>
                        <td>1:00</td>
                        <td>8:00</td>
                        <td><a href="#" style="color: black; font-weight: bold;">詳細</a></td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
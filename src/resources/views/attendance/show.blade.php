@extends('layouts.app')

@section('content')
    <div class="container" style="width: 500px; margin: 50px auto;">

        <h2 style="text-align: center; margin-bottom: 30px;">勤怠詳細</h2>

        <form method="POST" action="#">
            {{-- CSRFトークン（後でルーティングと合わせて調整） --}}
            @csrf

            <div style="border: 1px solid #ccc; border-radius: 8px; padding: 20px; background-color: #fdfdfd;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <tr>
                        <th style="text-align: left; padding: 8px;">氏名</th>
                        <td style="padding: 8px;">田中 太郎</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; padding: 8px;">日付</th>
                        <td style="padding: 8px;">2023/06/01</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; padding: 8px;">出勤</th>
                        <td style="padding: 8px;">
                            <input type="time" name="start_time" value="08:30"
                                style="width: 100%; padding: 5px; border: 1px solid #ccc;">
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; padding: 8px;">休憩</th>
                        <td style="padding: 8px;">
                            <input type="time" name="break_start" value="12:00"
                                style="width: 45%; padding: 5px; border: 1px solid #ccc;"> 〜
                            <input type="time" name="break_end" value="13:00"
                                style="width: 45%; padding: 5px; border: 1px solid #ccc;">
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; padding: 8px;">退勤</th>
                        <td style="padding: 8px;">
                            <input type="time" name="end_time" value="17:30"
                                style="width: 100%; padding: 5px; border: 1px solid #ccc;">
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; padding: 8px; vertical-align: top;">備考</th>
                        <td style="padding: 8px;">
                            <textarea name="note" rows="3"
                                style="width: 100%; padding: 5px; border: 1px solid #ccc;">修正の理由を記入してください。</textarea>
                        </td>
                    </tr>
                </table>

                <div style="text-align: center; margin-top: 20px;">
                    <button type="submit"
                        style="padding: 10px 30px; background-color: black; color: white; border: none;">修正申請</button>
                </div>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('attendance.index') }}"
                    style="display: inline-block; padding: 10px 30px; background-color: #ccc; color: black; text-decoration: none;">戻る</a>
            </div>

        </form>

    </div>
@endsection
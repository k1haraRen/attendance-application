@extends('layouts.app')
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

        <table style="width: 70%; background: #fff; border-radius: 5px;">
            <tr>
                <td style="width: 30%; padding-left: 50px; font-weight: bold;">名前</td>
                <td style="padding-left: 50px;">西　侑奈</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-left: 50px;">日付</td>
                <td>
                    <span style="margin-right: 20px; padding-left: 50px;">2023年</span>
                    <span style="">6月1日</span>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-left: 50px;">出勤・退勤</td>
                <td style="padding-left: 50px;">
                    <input type="time" name="start_time" value="09:00"
                        style="width: 130px; text-align: center; line-height: 22px; border: 1px solid rgb(228, 228, 233); font-size: 15px; font-weight: bold;">
                    〜
                    <input type="time" name="end_time" value="18:00"
                        style="width: 130px; text-align: center; line-height: 22px; border: 1px solid rgb(228, 228, 233); font-size: 15px; font-weight: bold;">
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-left: 50px;">休憩</td>
                <td style="padding-left: 50px;">
                    <input type="time" name="break_start" value="12:00"
                        style="width: 130px; text-align: center; line-height: 22px; border: 1px solid rgb(228, 228, 233); font-size: 15px; font-weight: bold;">
                    〜
                    <input type="time" name="break_end" value="13:00"
                        style="width: 130px; text-align: center; line-height: 22px; border: 1px solid rgb(228, 228, 233); font-size: 15px; font-weight: bold;">
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-left: 50px;">休憩2</td>
                <td style="padding-left: 50px;">
                    <input type="time" name="break2_start"
                        style="width: 130px; text-align: center; line-height: 22px; border: 1px solid rgb(228, 228, 233); font-size: 15px; font-weight: bold;">
                    〜
                    <input type="time" name="break2_end"
                        style="width: 130px; text-align: center; line-height: 22px; border: 1px solid rgb(228, 228, 233); font-size: 15px; font-weight: bold;">
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-left: 50px;">備考</td>
                <td style="padding-left: 50px;">
                    <textarea name="remarks" rows="4"
                        style="width: 50%; border: 1px solid rgb(228, 228, 233);">電話連絡のため</textarea>
                </td>
            </tr>
        </table>

        <div style="width: 70%; text-align: right; margin-top: 30px;">
            <button
                style="padding: 10px 30px; background-color: black; color: white; border: none; font-weight: bold; border-radius: 5px;">承認</button>
        </div>
    </div>
@endsection
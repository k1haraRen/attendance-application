@extends('layouts.app')

@section('content')
    <div class="container" style="text-align:center; padding: 40px 0;">
        <h2
            style="text-align: left; font-weight: bold; margin-left: 15%; margin-bottom: 20px; padding-left: 1%; border-left: 5px solid black;">
            申請一覧</h2>

        {{-- 切り替えボタン（申請中 / 承認済） --}}
        <div style="padding-left: 15%; text-align: left; margin-top: 50px; margin-bottom: 30px;">
            <a href="#"
                style="padding: 8px 20px; margin-right: 10px; background-color: black; color: white; text-decoration: none;">申請待ち</a>
            <a href="#" style="padding: 8px 20px; background-color: #ccc; color: black; text-decoration: none;">承認済み</a>
        </div>

        <table
            style="margin: 0 auto; width: 70%; border-collapse: collapse; border: 2px solid #00f; border-radius: 8px; overflow: hidden; background-color: white;">
            <thead style="background-color: #f5f5f5;">
                <tr>
                    <th style="padding: 10px;">状態</th>
                    <th style="padding: 10px;">名前</th>
                    <th style="padding: 10px;">対象日時</th>
                    <th style="padding: 10px;">申請理由</th>
                    <th style="padding: 10px;">申請日時</th>
                    <th style="padding: 10px;">詳細</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 6; $i++)
                    <tr style="border-top: 1px solid #ccc;">
                        <td style="padding: 10px;">承認待ち</td>
                        <td>09:00</td>
                        <td>2023/06/{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}(木)</td>
                        <td>遅延のため</td>
                        <td>2023/06/{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}(木)</td>
                        <td><a href="#" style="color: black; font-weight: bold;">詳細</a></td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
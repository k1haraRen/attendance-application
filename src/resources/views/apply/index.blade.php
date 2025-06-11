@extends('layouts.app')

@section('content')
    <div class="container" style="width: 80%; margin: 0 auto;">
        <h2 style="text-align: center; margin: 30px 0;">申請一覧</h2>

        {{-- 切り替えボタン（申請中 / 承認済） --}}
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="#"
                style="padding: 8px 20px; margin-right: 10px; background-color: black; color: white; text-decoration: none;">申請中</a>
            <a href="#" style="padding: 8px 20px; background-color: #ccc; color: black; text-decoration: none;">承認済</a>
        </div>

        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f0f0f0;">
                    <th style="padding: 10px; border: 1px solid #ccc;">氏名</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">日付</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">種別</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">理由</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">ステータス</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">詳細</th>
                </tr>
            </thead>
            <tbody>
                {{-- ここは後で@foreachで実装 --}}
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">田中 太郎</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">2023/06/01 08:30</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">遅刻</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">電車遅延のため</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">申請中</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <a href="#" style="text-decoration: underline; color: blue;">詳細を見る</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">佐藤 花子</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">2023/06/02 17:00</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">早退</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">通院のため</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">申請中</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <a href="#" style="text-decoration: underline; color: blue;">詳細を見る</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
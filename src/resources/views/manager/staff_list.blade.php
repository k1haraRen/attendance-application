@extends('layouts.app_admin')

@section('content')
    <div class="container" style="text-align:center; padding: 40px 0;">
        <h2
            style="text-align: left; font-weight: bold; margin-left: 15%; margin-bottom: 20px; padding-left: 1%; border-left: 5px solid black;">
            スタッフ一覧</h2>

        <table
            style="margin: 0 auto; width: 70%; border-collapse: collapse; border: 2px solid #00f; border-radius: 8px; overflow: hidden; background-color: white;">
            <thead style="background-color: #f5f5f5;">
                <tr>
                    <th style="padding: 10px;">名前</th>
                    <th style="padding: 10px;">メールアドレス</th>
                    <th style="padding: 10px;">月次勤怠</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr style="border-top: 1px solid #ccc;">
                        <td style="padding: 10px;">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('staff.edit', ['id' => $user->id]) }}" style="color: black; font-weight: bold;">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
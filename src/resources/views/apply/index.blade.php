@extends('layouts.app')

@section('content')
    <div class="container" style="text-align:center; padding: 40px 0;">
        <h2 style="text-align: left; font-weight: bold; margin-left: 15%; margin-bottom: 20px; padding-left: 1%; border-left: 5px solid black;">申請一覧</h2>

        <div style="padding-left: 15%; text-align: left; margin-top: 50px; margin-bottom: 30px;">
            <a href="{{ route('request.list', ['status' => 'pending']) }}"
                style="padding: 8px 20px; margin-right: 10px; background-color: {{ $status === 'pending' ? 'black' : '#ccc' }}; color: {{ $status === 'pending' ? 'white' : 'black' }}; text-decoration: none;">
                申請待ち
            </a>
            <a href="{{ route('request.list', ['status' => 'approved']) }}"
                style="padding: 8px 20px; background-color: {{ $status === 'approved' ? 'black' : '#ccc' }}; color: {{ $status === 'approved' ? 'white' : 'black' }}; text-decoration: none;">
                承認済み
            </a>
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
            @foreach ($corrections as $correction)
                <tr style="border-top: 1px solid #ccc;">
                    <td style="padding: 10px;">
                        {{ $correction->status === 'pending' ? '承認待ち' : '承認済み' }}
                    </td>
                    <td>{{ $correction->attendance->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($correction->attendance->date)->format('Y/m/d') }}</td>
                    <td>{{ $correction->remarks }}</td>
                    <td>{{ $correction->created_at->format('Y/m/d') }}</td>
                    <td>
                        <a href="{{ route('attendance.edit', $correction->attendance->id) }}" style="color: black; font-weight: bold;">詳細</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
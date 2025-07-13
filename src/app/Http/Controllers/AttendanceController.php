<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    public function attendance()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();

        if (!$attendance) {
            $status = 'none';
        } elseif ($attendance->taikin) {
            $status = 'finished';
        } elseif (
            ($attendance->rests1 && !$attendance->reste1) ||
            ($attendance->rests2 && !$attendance->reste2)
        ) {
            $status = 'resting';
        } else {
            $status = 'working';
        }

        return view('attendance/attendance', compact('status', 'attendance'));
    }

    public function start()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // 同日の重複出勤チェック
        $already = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->exists();

        if ($already) {
            return back()->with('error', '本日はすでに出勤しています');
        }

        // 出勤登録
        Attendance::create([
            'user_id' => $user->id,
            'year' => now()->year,
            'date' => $today,
            'days' => ['日', '月', '火', '水', '木', '金', '土'][now()->dayOfWeek],
            'syukkin' => now()->format('H:i:s'),
            'state' => true,
        ]);

        return redirect()->route('attendance')->with('status', '出勤しました');
    }

    // 退勤
    public function end()
    {
        $attendance = $this->getTodayAttendance();
        if (!$attendance || $attendance->taikin) {
            return back()->with('error', '退勤できません');
        }

        $attendance->update([
            'taikin' => now()->format('H:i:s'),
            'state' => false,
        ]);

        return redirect()->route('attendance')->with('status', '退勤しました');
    }

    // 休憩開始
    public function break()
    {
        $attendance = $this->getTodayAttendance();
        if (!$attendance) {
            return back()->with('error', '出勤していません');
        }

        if (!$attendance->rests1) {
            // 1回目の休憩
            $attendance->update([
                'rests1' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '1回目休憩開始');
        }

        if ($attendance->rests1 && $attendance->reste1 && !$attendance->rests2) {
            // 2回目の休憩
            $attendance->update([
                'rests2' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '2回目休憩開始');
        }

        // それ以上は不可
        return back()->with('error', '休憩は2回までです');
    }

    // 休憩戻り
    public function resume()
    {
        $attendance = $this->getTodayAttendance();
        if (!$attendance) {
            return back()->with('error', '出勤していません');
        }

        if ($attendance->rests1 && !$attendance->reste1) {
            // 1回目の休憩戻り
            $attendance->update([
                'reste1' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '1回目休憩戻り');
        }

        if ($attendance->rests2 && !$attendance->reste2) {
            // 2回目の休憩戻り
            $attendance->update([
                'reste2' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '2回目休憩戻り');
        }

        return back()->with('error', '休憩戻りできません');
    }

    // 共通：当日の出勤データ取得
    private function getTodayAttendance()
    {
        return Attendance::where('user_id', Auth::id())
            ->where('date', Carbon::today())
            ->first();
    }
}

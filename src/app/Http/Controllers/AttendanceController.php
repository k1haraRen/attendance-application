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

        $already = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->exists();

        if ($already) {
            return back()->with('error', '本日はすでに出勤しています');
        }

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
    public function break()
    {
        $attendance = $this->getTodayAttendance();
        if (!$attendance) {
            return back()->with('error', '出勤していません');
        }

        if (!$attendance->rests1) {
            $attendance->update([
                'rests1' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '1回目休憩開始');
        }

        if ($attendance->rests1 && $attendance->reste1 && !$attendance->rests2) {
            $attendance->update([
                'rests2' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '2回目休憩開始');
        }

        return back()->with('error', '休憩は2回までです');
    }
    public function resume()
    {
        $attendance = $this->getTodayAttendance();
        if (!$attendance) {
            return back()->with('error', '出勤していません');
        }

        if ($attendance->rests1 && !$attendance->reste1) {
            $attendance->update([
                'reste1' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '1回目休憩戻り');
        }
        if ($attendance->rests2 && !$attendance->reste2) {
            $attendance->update([
                'reste2' => now()->format('H:i:s'),
            ]);
            return redirect()->route('attendance')->with('status', '2回目休憩戻り');
        }

        return back()->with('error', '休憩戻りできません');
    }
    private function getTodayAttendance()
    {
        return Attendance::where('user_id', Auth::id())
            ->where('date', Carbon::today())
            ->first();
    }

    public function attendanceList(Request $request)
    {
        $user = auth()->user();

        $month = $request->input('month')
            ? Carbon::createFromFormat('Y-m', $request->input('month'))->startOfMonth()
            : now()->startOfMonth();

        $attendances = Attendance::where('user_id', $user->id)
            ->whereYear('date', $month->year)
            ->whereMonth('date', $month->month)
            ->orderBy('date')
            ->get();

        $prevMonth = $month->copy()->subMonth()->format('Y-m');
        $nextMonth = $month->copy()->addMonth()->format('Y-m');

        return view('attendance.index', [
            'attendances' => $attendances,
            'monthLabel' => $month->format('Y/m'),
            'prevMonth' => $prevMonth,
            'nextMonth' => $nextMonth,
        ]);
    }
}

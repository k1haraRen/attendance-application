<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Attendance;
use App\Models\AttendanceCorrection;
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

        return view('attendance.attendance', compact('status', 'attendance'));
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

    public function edit($id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);

        $hasPendingCorrection = AttendanceCorrection::where('attendance_id', $id)
            ->where('status', 'pending')
            ->exists();

        return view('attendance.show', compact('attendance', 'hasPendingCorrection'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_id' => 'required|exists:attendances,id',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time|after_or_equal:break_start|after_or_equal:break_2start',
            'break_start' => 'nullable|date_format:H:i',
            'break_end' => 'nullable|date_format:H:i|after_or_equal:break_start',
            'break2_start' => 'nullable|date_format:H:i',
            'break2_end' => 'nullable|date_format:H:i|after_or_equal:break2_start',
            'remarks' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        AttendanceCorrection::create([
            'user_id' => Auth::id(),
            'attendance_id' => $request->attendance_id,
            'syukkin' => $request->start_time,
            'taikin' => $request->end_time,
            'rests1' => $request->break_start,
            'reste1' => $request->break_end,
            'rests2' => $request->break2_start,
            'reste2' => $request->break2_end,
            'remarks' => $request->remarks,
            'status' => 'pending',
        ]);

        return redirect()->route('attendance.list');
    }

    public function requestList(Request $request)
    {
        $status = $request->query('status', 'pending');
        $corrections = AttendanceCorrection::with('attendance.user')
            ->where('status', $status)
            ->latest()
            ->get();

        return view('apply.index', compact('corrections', 'status'));
    }
}

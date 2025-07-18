<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceCorrection;
use App\Models\User;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function managerAdmin(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();

        $attendances = Attendance::with('user')
            ->whereDate('date', $date)
            ->get();

        return view('manager/admin', [
            'attendances' => $attendances,
            'date' => $date,
            'prevDate' => $date->copy()->subDay()->format('Y-m-d'),
            'nextDate' => $date->copy()->addDay()->format('Y-m-d'),
        ]);
    }

    public function applyApprove($id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);
        return view('manager.attendance_detail', compact('attendance'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time|after_or_equal:break_start|after_or_equal:break_2start',
            'break_start' => 'nullable|date_format:H:i',
            'break_end' => 'nullable|date_format:H:i|after_or_equal:break_start',
            'break2_start' => 'nullable|date_format:H:i',
            'break2_end' => 'nullable|date_format:H:i|after_or_equal:break2_start',
            'remarks' => 'nullable|string|max:255',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->syukkin = $request->start_time;
        $attendance->taikin = $request->end_time;
        $attendance->rests1 = $request->break_start;
        $attendance->reste1 = $request->break_end;
        $attendance->rests2 = $request->break2_start;
        $attendance->reste2 = $request->break2_end;
        $attendance->save();

        return redirect()->route('apply.approve', $id);
    }

    public function staffList()
    {
        $users = User::all();
        return view('manager.staff_list', compact('users'));
    }

    public function staffEdit($id, Request $request)
    {
        $user = User::findOrFail($id);

        $year = $request->query('year', Carbon::now()->year);
        $month = $request->query('month', Carbon::now()->month);

        $attendances = Attendance::where('user_id', $id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->get();

        $currentMonth = Carbon::createFromDate($year, $month, 1);

        return view('manager.staff_edit', compact('user', 'attendances', 'currentMonth'));
    }

    public function applyList(Request $request)
    {
        $status = $request->query('status', 'pending');
        $corrections = AttendanceCorrection::with('attendance.user')
            ->where('status', $status)
            ->latest()
            ->get();

        return view('manager.apply_list', compact('corrections', 'status'));
    }

    public function show($id)
    {
        $correction = AttendanceCorrection::with(['attendance.user'])->findOrFail($id);
        return view('manager.apply_approve', compact('correction'));
    }

    public function approve(Request $request, $id)
    {
        $correction = AttendanceCorrection::with('attendance')->findOrFail($id);
        $attendance = $correction->attendance;

        $attendance->update([
            'syukkin' => $correction->start_time,
            'taikin' => $correction->end_time,
            'rests1' => $correction->break_start,
            'reste1' => $correction->break_end,
            'rests2' => $correction->break2_start,
            'reste2' => $correction->break2_end,
        ]);

        $correction->update(['status' => 'approved']);

        return redirect()->route('admin.corrections.show', $id);
    }
}

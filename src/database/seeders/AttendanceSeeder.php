<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 1,
                'year' => 2025,
                'date' => "2025-06-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-06-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 1,
                'year' => 2025,
                'date' => "2025-07-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-07-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 1,
                'year' => 2025,
                'date' => "2025-08-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-08-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 2,
                'year' => 2025,
                'date' => "2025-06-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-06-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 2,
                'year' => 2025,
                'date' => "2025-07-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-07-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 2,
                'year' => 2025,
                'date' => "2025-08-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-08-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 3,
                'year' => 2025,
                'date' => "2025-06-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-06-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 3,
                'year' => 2025,
                'date' => "2025-07-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-07-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };

        for ($i = 1; $i <= 30; $i++) {
            Attendance::create([
                'user_id' => $user->id ?? 3,
                'year' => 2025,
                'date' => "2025-08-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'days' => ['日', '月', '火', '水', '木', '金', '土'][date('w', strtotime("2025-08-$i"))],
                'syukkin' => '09:00:00',
                'taikin' => '18:00:00',
                'rests1' => '12:00:00',
                'reste1' => '13:00:00',
                'rests2' => null,
                'reste2' => null,
            ]);
        };
    }
}

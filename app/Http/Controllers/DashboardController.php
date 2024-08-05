<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residential;
use App\Models\ResidentialBlock;
use App\Models\Device;
use App\Models\User;
use App\Models\EmergencyState;
use App\Models\EmergencyReport;

class DashboardController extends Controller
{
    public function index()
    {

        $residentialCount = Residential::count();
        $residentialBlockCount = ResidentialBlock::count();
        $userCount = User::selectRaw('
            COUNT(*) as total_count,
            SUM(CASE WHEN access = "1" THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN access = "0" THEN 1 ELSE 0 END) as inactive_count
        ') ->first();

        $userActivePercentage = ($userCount->active_count / $userCount->total_count) * 100;
        $userInactivePercentage = ($userCount->inactive_count / $userCount->total_count) * 100;

        $deviceCount = Device::selectRaw('
            COUNT(*) as total_count,
            SUM(CASE WHEN access = "1" THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN access = "0" THEN 1 ELSE 0 END) as inactive_count
        ')->first();

        $deviceActivePercentage = ($deviceCount->active_count / $deviceCount->total_count) * 100;
        $deviceInactivePercentage = ($deviceCount->inactive_count / $deviceCount->total_count) * 100;

        $emergencyState = EmergencyState::with('device.residentialBlock.residential')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

        return view('dashboard.index', [
            'residentialCount' => $residentialCount,
            'residentialBlockCount' => $residentialBlockCount,
            'userCount' => $userCount,
            'userActivePercentage' => $userActivePercentage,
            'userInactivePercentage' => $userInactivePercentage,
            'deviceCount' => $deviceCount,
            'deviceActivePercentage' => $deviceActivePercentage,
            'deviceInactivePercentage' => $deviceInactivePercentage,
            'emergencyState' => $emergencyState]);
    }
}

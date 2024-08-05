<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residential;
use App\Models\ResidentialBlock;
use App\Models\Device;
use App\Models\User;
use App\Models\EmergencyState;
use App\Models\EmergencyReport;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role != 'Admin') {
            $emergencyState = EmergencyState::with('device.residentialBlock.residential')
                                            ->whereHas('device.residentialBlock.residential', function ($query) use ($user) {
                                                    $query->where('id', $user->id_residential);
                                                })
                                            ->limit(5)
                                            ->orderBy('created_at', 'desc')
                                            ->get();
            $residentialCount = 1;
            $residentialBlockCount = ResidentialBlock::with('residential')
                                    ->whereHas('residential', function($query) use ($user) {
                                            $query->where('id', $user->id_residential); })
                                            ->count();

            $deviceCount = Device::with('residentialBlock.residential')
                        ->selectRaw('
                            COUNT(*) as total_count,
                            SUM(CASE WHEN access = "1" THEN 1 ELSE 0 END) as active_count,
                            SUM(CASE WHEN access = "0" THEN 1 ELSE 0 END) as inactive_count
                            ')
                            ->whereHas('residentialBlock.residential', function($query) use ($user) {
                                $query->where('id', $user->id_residential);
                            })
                            ->first();

            $deviceActivePercentage = ($deviceCount->active_count / $deviceCount->total_count) * 100;
            $deviceInactivePercentage = ($deviceCount->inactive_count / $deviceCount->total_count) * 100;

            $userCount = User::with('residential')
                    ->selectRaw('
                        COUNT(*) as total_count,
                        SUM(CASE WHEN access = "1" THEN 1 ELSE 0 END) as active_count,
                        SUM(CASE WHEN access = "0" THEN 1 ELSE 0 END) as inactive_count
                    ')->whereHas('residential', function($query) use ($user) {
                        $query->where('id', $user->id_residential);
                    })
                    ->first();

            $userActivePercentage = ($userCount->active_count / $userCount->total_count) * 100;
            $userInactivePercentage = ($userCount->inactive_count / $userCount->total_count) * 100;

        } else {
            $emergencyState = EmergencyState::with('device.residentialBlock.residential')
                                            ->limit(5)
                                            ->orderBy('created_at', 'desc')
                                            ->get();
            $residentialCount = Residential::count();
            $residentialBlockCount = ResidentialBlock::with('residential')->count();

            $deviceCount = Device::selectRaw('
            COUNT(*) as total_count,
            SUM(CASE WHEN access = "1" THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN access = "0" THEN 1 ELSE 0 END) as inactive_count
            ')->first();

            $deviceActivePercentage = ($deviceCount->active_count / $deviceCount->total_count) * 100;
            $deviceInactivePercentage = ($deviceCount->inactive_count / $deviceCount->total_count) * 100;

            $userCount = User::selectRaw('
            COUNT(*) as total_count,
            SUM(CASE WHEN access = "1" THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN access = "0" THEN 1 ELSE 0 END) as inactive_count
            ') ->first();

            $userActivePercentage = ($userCount->active_count / $userCount->total_count) * 100;
            $userInactivePercentage = ($userCount->inactive_count / $userCount->total_count) * 100;

        }

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

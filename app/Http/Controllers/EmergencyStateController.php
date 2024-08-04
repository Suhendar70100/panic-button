<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyState;


class EmergencyStateController extends Controller
{
    public function index()
    {
        $emergencyState = EmergencyState::with('device.residentialBlock.residential')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('emergencyState.index', compact('emergencyState'));
    }
}

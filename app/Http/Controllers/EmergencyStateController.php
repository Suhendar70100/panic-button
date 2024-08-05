<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyState;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class EmergencyStateController extends Controller
{
    public function index()
    {
        return view('emergencyState.index');
    }

    public function dataTable(): JsonResponse
    {
        $user = Auth::user();

        if($user->role == 'Admin'){
            $data = EmergencyState::with('device.residentialBlock.residential')
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $data = EmergencyState::with('device.residentialBlock.residential')
            ->whereHas('device.residentialBlock.residential', function ($query) use ($user) {
                $query->where('id', $user->id_residential);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        }


        return DataTables::of($data)
        ->addColumn('owner_device', function ($data) {
            return $data->device->owner_device;
        })
        ->addColumn('location', function ($data) {
            return $data->device->residentialblock->residential->name . ' - ' . $data->device->residentialblock->name_block . ' No. ' . $data->device->house_number;
        })
        ->addColumn('phone', function ($data) {
            return $data->device->phone;
        })
        ->toJson();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\DeviceActivity;
use App\Models\Device;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class DeviceActivityController extends Controller
{
    public function index()
    {
        return view('deviceActivity.index');
    }

    public function dataTable(Request $request): JsonResponse
    {
        $data = DeviceActivity::with('device.residentialblock.residential')->orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('owner_device', function (DeviceActivity $deviceActivity) {
                return $deviceActivity->device->owner_device;
            })
            ->addColumn('code_device', function (DeviceActivity $deviceActivity) {
                return $deviceActivity->device->code_device;
            })
            ->addColumn('location', function (DeviceActivity $deviceActivity) {
                $device = $deviceActivity->device;
                $residentialBlock = $device ? $device->residentialBlock : null;
                $resodential = $residentialBlock && $residentialBlock->residential ? $residentialBlock->residential : null;
                return $residentialBlock->name_block . ' No.' . $device->house_number . ' - ' . $resodential->name;
            })
            ->toJson();

    }
}

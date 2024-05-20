<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Device;
use Illuminate\View\View;
use App\Models\Residential;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\ResidentialCreateRequest;
use App\Http\Requests\ResidentialUpdateRequest;

class HistoryButtonController extends Controller
{
    public function index()
    {
        return view('historyButton.index');
    }

public function dataTable(Request $request): JsonResponse
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $query = Device::with(['residentialBlock', 'histroyButtons']);

    if ($startDate && $endDate) {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        $query->whereHas('histroyButtons', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        });
    }

    $data = $query->get();

    $formattedData = [];
    foreach ($data as $device) {
        $residentialBlockName = $device->residentialBlock ? $device->residentialBlock->name_block : null;
        $residentialName = $device->residentialBlock && $device->residentialBlock->residential ? $device->residentialBlock->residential->name : null;
        $houseNumber = $device->house_number;
        $state = '-';
        $time = '-';

        if ($device->histroyButtons instanceof Collection) {
            $state = $device->histroyButtons->isEmpty() ? '-' : $device->histroyButtons->first()->state;
            $time = $device->histroyButtons->isEmpty() ? '-' : $device->histroyButtons->first()->time;
        }

        $formattedData[] = [
            'guid' => $device->guid,
            'residential_name' => $residentialName,
            'residential_block' => $residentialBlockName,
            'house_number' => $houseNumber,
            'state' => $state,
            'time' => $time,
        ];
    }

    return response()->json($formattedData);
}

}

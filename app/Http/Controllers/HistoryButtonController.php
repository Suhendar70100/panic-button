<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Device;
use Illuminate\View\View;
use App\Models\Residential;
use Illuminate\Http\Request;
use App\Models\HistoryButton;
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

        $query = HistoryButton::with(['device.residentialBlock.residential']);

        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $data = $query->get();

        $formattedData = [];
        foreach ($data as $historyButton) {
            $device = $historyButton->device;
            $residentialBlock = $device ? $device->residentialBlock : null;
            $residentialName = $residentialBlock && $residentialBlock->residential ? $residentialBlock->residential->name : null;
            $residentialBlockName = $residentialBlock ? $residentialBlock->name_block : null;
            $houseNumber = $device ? $device->house_number : null;

            $formattedData[] = [
                'guid' => $historyButton->guid,
                'residential_name' => $residentialName,
                'residential_block' => $residentialBlockName,
                'house_number' => $houseNumber,
                'date' => $historyButton->date,
                'time' => $historyButton->time,
                'state' => $historyButton->state,
            ];
        }

        return response()->json($formattedData);
    }


}

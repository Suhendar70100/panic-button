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

//     public function dataTable(Request $request): JsonResponse
// {
//     // Ambil tanggal awal dan akhir dari permintaan
//     $startDate = $request->input('start_date');
//     $endDate = $request->input('end_date');

//     // Query data dengan filter tanggal
//     $query = Device::with(['residentialBlock', 'histroyButtons']);

//     if ($startDate && $endDate) {
//         $query->whereHas('histroyButtons', function ($query) use ($startDate, $endDate) {
//             $query->whereBetween('created_at', [$startDate, $endDate]);
//         });
//     }

//     // Ambil data sesuai dengan query yang telah difilter
//     $data = $query->get();

//     // Format data sesuai dengan kebutuhan DataTable
//     $formattedData = [];
//     foreach ($data as $device) {
//         $residentialBlockName = $device->residentialBlock ? $device->residentialBlock->name_block : null;
//         $houseNumber = $device->house_number;
//         $state = '-';
//         $time = '-';

//         if ($device->histroyButtons instanceof Collection) {
//             $state = $device->histroyButtons->isEmpty() ? '-' : $device->histroyButtons->first()->state;
//             $time = $device->histroyButtons->isEmpty() ? '-' : $device->histroyButtons->first()->time;
//         }

//         $formattedData[] = [
//             'guid' => $device->guid,
//             'residential_block' => $residentialBlockName,
//             'house_number' => $houseNumber,
//             'state' => $state,
//             'time' => $time,
//         ];
//     }

//     // Return data dalam format JSON
//     return response()->json($formattedData);
// }

public function dataTable(Request $request): JsonResponse
{
    // Ambil tanggal awal dan akhir dari permintaan
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Query data dengan filter tanggal
    $query = Device::with(['residentialBlock', 'histroyButtons']);

    if ($startDate && $endDate) {
        // Ubah format tanggal ke format yang dikenali oleh database
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        $query->whereHas('histroyButtons', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        });
    }

    // Ambil data sesuai dengan query yang telah difilter
    $data = $query->get();

    // Format data sesuai dengan kebutuhan DataTable
    $formattedData = [];
    foreach ($data as $device) {
        $residentialBlockName = $device->residentialBlock ? $device->residentialBlock->name_block : null;
        $houseNumber = $device->house_number;
        $state = '-';
        $time = '-';

        if ($device->histroyButtons instanceof Collection) {
            $state = $device->histroyButtons->isEmpty() ? '-' : $device->histroyButtons->first()->state;
            $time = $device->histroyButtons->isEmpty() ? '-' : $device->histroyButtons->first()->time;
        }

        $formattedData[] = [
            'guid' => $device->guid,
            'residential_block' => $residentialBlockName,
            'house_number' => $houseNumber,
            'state' => $state,
            'time' => $time,
        ];
    }

    // Return data dalam format JSON
    return response()->json($formattedData);
}

}

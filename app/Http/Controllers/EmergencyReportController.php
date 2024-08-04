<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyState;
use App\Models\EmergencyReport;
use App\Models\ResidentialBlock;
use App\Models\Residential;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use App\Http\Requests\EmergencyReportCreateRequest;
use App\Http\Requests\EmergencyReportUpdateRequest;



class EmergencyReportController extends Controller
{

    public function index()
    {
        {
            $emergencyState = EmergencyState::with('device.residentialBlock.residential')
                                                ->where(function ($query) {
                                                    $query->where('status', 'Darurat')
                                                        ->orWhere('status', 'Belum dilaporkan');
                                                })
                                                ->orderBy('created_at', 'desc')
                                                ->get();

            return view('emergencyReport.index', compact('emergencyState'));
        }
    }

    public function dataTable(): JsonResponse
    {
        $data = EmergencyReport::with('emergencyState.device.residentialblock.residential')->get();

        return DataTables::of($data)
        ->addColumn('aksi', function ($row) {
            return "<a href='#' data-id='$row->id' class='mdi mdi-trash-can text-danger btn-delete'></a>";
        })
        ->addColumn('owner_device', function ($data) {
            return $data->emergencyState->device->owner_device;
        })
        ->addColumn('location', function ($data) {
            return $data->emergencyState->device->residentialblock->residential->name . ' - ' . $data->emergencyState->device->residentialblock->name_block . ' No. ' . $data->emergencyState->device->house_number;
        })
        ->rawColumns(['aksi'])
        ->toJson();
    }
    public function store(EmergencyReportCreateRequest $request): JsonResponse
    {

        try {
            $data = $request->validated();
            EmergencyReport::create($data);

            $emergencyState = EmergencyState::find($data['id_emergency_state']);
            $emergencyState->status = 'Ditangani';
            $emergencyState->save();

            return response()->json(
                ['message' => 'Data berhasil ditambahkan'],
                201
            );

        } catch (Exception $exception) {
            return response()->json(
                ['message' => $exception->getMessage()],
                400
            );
        }
    }

    public function show($id): JsonResponse
    {
        $emergencyReport = EmergencyReport::find($id);

        if (!$emergencyReport) {
            return response()->json(['message' => 'Data Laporan tidak ditemukan'], 404);
        }

        return response()->json($emergencyReport);
    }

    public function update(EmergencyReportUpdateRequest $request, $id): JsonResponse
    {
            try {
                $residentialBlock = EmergencyReport::find($id);
                $data = $request->validated();
                $residentialBlock->update($data);

                return response()->json(
                    data: ['message' => 'Data berhasil di ubah'],
                    status: 201
                );

            } catch (Exception $exception) {
                return response()->json(
                    data: ['message' => $exception->getMessage()],
                    status: 400
                );
            }

    }

    public function delete($id): JsonResponse
    {
        $emergencyReport = EmergencyReport::find($id);

        if (!$emergencyReport) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $emergencyState = EmergencyState::find($emergencyReport->id_emergency_state);
        $emergencyState->status = 'Belum dilaporkan';
        $emergencyState->save();

        $emergencyReport->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}

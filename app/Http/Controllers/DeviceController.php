<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\deviceCreateRequest;
use App\Http\Requests\deviceUpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\Device;
use App\Models\ResidentialBlock;
use App\Models\Residential;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    public function index()
    {
        $residentialBlockData = ResidentialBlock::with('residential')->get();

        return view('device.index', compact('residentialBlockData'));
    }

    public function dataTable(): JsonResponse
    {
        $data = Device::with('residentialblock.residential')->get();

        return DataTables::of($data)
            ->addColumn('aksi', function ($row) {
                return " <a href='#' data-id='$row->id' class='mdi mdi-pencil text-warning btn-edit'></a>
            <a href='#' data-id='$row->id' class='mdi mdi-trash-can text-danger btn-delete'></a>";
            })
            ->addColumn('name_residential_block', function (Device $device) {
                return $device->residentialblock->name_block;
            })
            ->addColumn('name_residential', function (Device $device) {
                return $device->residentialblock->residential->name;
            })

            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function store(DeviceCreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            Device::query()->create($data);

            return response()->json(
                data: ['message' => 'Data berhasil di tambahkan'],
                status: 201
            );
        } catch (Exception $exception) {
            return response()->json(
                data: ['message' => $exception->getMessage()],
                status: 400
            );
        }
    }

    public function show($id): JsonResponse
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Data perumahan tidak ditemukan'], 404);
        }

        return response()->json($device);
    }

    public function update(DeviceUpdateRequest $request, $id): JsonResponse
    {

        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $device->code_device = $request->code_device;
        $device->id_residential_block = $request->id_residential_block;
        $device->owner_device = $request->owner_device;
        $device->house_number = $request->house_number;
        $device->access = $request->access;
        $device->save();

        return response()->json(['message' => 'Data berhasil diperbarui'], 200);
    }

    public function delete($id): JsonResponse
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $device->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}

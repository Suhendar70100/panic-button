<?php

namespace App\Http\Controllers;

use App\Models\Residential;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ResidentialCreateRequest;
use App\Http\Requests\ResidentialUpdateRequest;

class ResidentialController extends Controller
{
    public function index()
    {
        return view('residential.index');
    }

    public function dataTable(): JsonResponse
    {
        $data = Residential::query()->get();

        return DataTables::of($data)
        ->addColumn('aksi', function ($row) {
            return " <a href='#' data-id='$row->id' class='mdi mdi-pencil text-warning btn-edit'></a>
                            <a href='#' data-id='$row->id' class='mdi mdi-trash-can text-danger btn-delete'></a>";
        })
        ->rawColumns(['aksi'])
        ->toJson();
    }

    public function store(ResidentialCreateRequest $request): JsonResponse
    {

        try {
            $data = $request->validated();
            Residential::query()->create($data);

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
        $residential = Residential::find($id);

        if (!$residential) {
            return response()->json(['message' => 'Data perumahan tidak ditemukan'], 404);
        }

        return response()->json($residential);
    }

    public function update(ResidentialUpdateRequest $request, $id): JsonResponse
    {
        $residential = Residential::find($id);

        if (!$residential) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $residential->name = $request->name;
        $residential->address = $request->address;
        $residential->save();

        return response()->json(['message' => 'Data berhasil diperbarui'], 200);
    }

    public function delete($id): JsonResponse
    {
        $residential = Residential::find($id);

        if (!$residential) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $residential->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

}
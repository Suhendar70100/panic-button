<?php

namespace App\Http\Controllers;

use App\Models\ResidentialBlock;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ResidentialBlockCreateRequest;
use App\Http\Requests\ResidentialBlockUpdateRequest;
use App\Models\Residential;
use Illuminate\Http\Request;

class ResidentialBlockController extends Controller
{
    public function index()
    {
        $residentialData = Residential::all();

        $usedResidentialIds = ResidentialBlock::pluck('id_residential')->toArray();

        return view('residentialblock.index', compact('residentialData', 'usedResidentialIds'));
    }

    public function dataTable(): JsonResponse
    {
        $data = ResidentialBlock::query()->get();

        return DataTables::of($data)
        ->addColumn('aksi', function ($row) {
            return " <a href='#' data-id='$row->code_block' class='mdi mdi-pencil text-warning btn-edit'></a>
                            <a href='#' data-id='$row->code_block' class='mdi mdi-trash-can text-danger btn-delete'></a>";
        })
        ->addColumn('perumahan', function (ResidentialBlock $residentialBlock) {
            return $residentialBlock->residential->name;
        })
        ->rawColumns(['aksi', 'perumahan'])
        ->toJson();
    }
    public function store(ResidentialBlockCreateRequest $request): JsonResponse
    {

        try {
            $data = $request->validated();
            ResidentialBlock::create($data);
    
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

    public function show($code_block): JsonResponse
    {
        $residentialBlock = ResidentialBlock::find($code_block);

        if (!$residentialBlock) {
            return response()->json(['message' => 'Data perumahan tidak ditemukan'], 404);
        }

        return response()->json($residentialBlock);
    }

    public function update(ResidentialBlockUpdateRequest $request, $code_block): JsonResponse
    {
            try {
                $residentialBlock = ResidentialBlock::find($code_block);
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

    public function delete($code_block): JsonResponse
    {
        $residentialBlock = ResidentialBlock::find($code_block);

        if (!$residentialBlock) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $residentialBlock->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}

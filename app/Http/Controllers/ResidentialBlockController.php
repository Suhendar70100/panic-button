<?php

namespace App\Http\Controllers;

use App\Models\ResidentialBlock;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ResidentialBlockCreateRequest;
use App\Http\Requests\ResidentialBlockUpdateRequest;
use Illuminate\Http\Request;

class ResidentialBlockController extends Controller
{
    public function index()
    {
        return view('residentialblock.index');
    }

    public function dataTableBlock(): JsonResponse
    {
        $order = Request::input('order', 'DESC');
        $perPage = Request::input('per_page', 10);
        $search = Request::input('search', '');

        $query = ResidentialBlock::query()
            ->where('name_block', 'like', "%$search%")
            ->orderBy('name_block', $order);

        $data = $query->paginate($perPage);

        return DataTables::of($data)
            ->addColumn('aksi', function ($row) {
                return "<a href='#' data-id='$row->id' class='mdi mdi-pencil text-warning btn-edit'></a>
                            <a href='#' data-id='$row->id' class='mdi mdi-trash-can text-danger btn-delete'></a>";
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }
        public function storeBlock(ResidentialBlockCreateRequest $request): JsonResponse
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

    public function showBlock($id): JsonResponse
    {
        $residentialBlock = ResidentialBlock::find($id);

        if (!$residentialBlock) {
            return response()->json(['message' => 'Data perumahan tidak ditemukan'], 404);
        }

        return response()->json($residentialBlock);
    }

    public function updateBlock(ResidentialBlockUpdateRequest $request, $id): JsonResponse
    {
        $residentialBlock = ResidentialBlock::find($id);

        if (!$residentialBlock) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $residentialBlock->code_block = $request->code_block;
        $residentialBlock->id_residential = $request->id_residential;
        $residentialBlock->name_block = $request->name_block;
        $residentialBlock->save();

        return response()->json(['message' => 'Data berhasil diperbarui'], 200);
    }

    public function deleteBlock($id): JsonResponse
    {
        $residentialBlock = ResidentialBlock::find($id);

        if (!$residentialBlock) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $residentialBlock->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}

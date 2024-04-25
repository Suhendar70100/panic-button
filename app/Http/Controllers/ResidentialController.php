<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolStoreRequest;
use App\Http\Requests\SchoolUpdateRequest;
use App\Models\Residential;
use App\Models\School;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

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

}
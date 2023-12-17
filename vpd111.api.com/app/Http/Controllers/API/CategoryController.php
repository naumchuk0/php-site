<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function getAll() {
        $list = \App\Models\Categories::all();
        return response()->json($list,200, ['Charset'=>'utf-8']);
    }
}

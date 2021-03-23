<?php

namespace App\Http\Controllers;

use App\Dimension;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DimensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $dimensions = Dimension::orderBy('id', 'desc')
            ->where('active',true)
            ->get();
        return response()->json($dimensions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $dimension = new Dimension;
        $dimension->dimension = $request->dimension;
        $dimension->save();
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $dimension = Dimension::findOrFail($id);
        return response()->json($dimension);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $dimension = Dimension::findOrFail($id);
        $dimension->dimension = $request->dimension;
        $dimension->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $dimension = Dimension::where('id','=',$id)
                    ->with('questions')
                    ->get()->first();

        if (!is_object($dimension->questions)){
            $dimension->active = false;
            $dimension->save();
        }
        return response()->json($dimension);
    }
}

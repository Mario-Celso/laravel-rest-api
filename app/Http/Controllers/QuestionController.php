<?php

namespace App\Http\Controllers;

use App\Dimension;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')
            ->with('dimension')
            ->get();
        return response()->json($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {

        $dimension = Dimension::find($request->dimension_id);

        if (is_object($dimension)) {
            $question = new Question;
            $question->dimension_id = $dimension->id;
            $question->question = $request->question;
            $question->save();
            return response()->json($question);
        }
        return response()->json("Não existe essa dimensão");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id)
            ->with('dimension')
            ->first();
        return response()->json($question);
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

        $dimension = Dimension::find($request->dimension_id);
        if (is_object($dimension)) {
            $question = Question::findOrFail($id);
            $question->dimension_id = $dimension->id;
            $question->question = $request->question;
            $question->save();
            return response()->json($question);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json($question);
    }
}

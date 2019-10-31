<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $exams = Exam::query()->select('id', 'code', 'name', 'start_time', 'end_time')->get();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }

        foreach ($exams as $key => $value) {
            $exams[$key]->links = [[
                'ref' => 'exam',
                'href' => "/api/v1/exams/$value->code",
                'action' => 'GET'
            ]];
        }
        return response()->json($exams, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $examId
     * @return Response
     */
    public function show($examId)
    {
        try {
            $exam = Exam::query()
                ->select('id', 'code', 'name', 'start_time', 'end_time')
                ->where('id', '=', $examId)
                ->first();
        } catch (\Exception $e) {
            // Log this
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }

        if(!$exam) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $exam['links'] = [[
            'ref' => 'exam',
            'href' => "/api/v1/exams/$examId",
            'action' => 'PUT'
        ], [
            'ref' => 'exam',
            'href' => "/api/v1/exams/$examId",
            'action' => 'DELETE'
        ], [
            'rel' => 'exams',
            'href' => '/api/v1/exams',
            'action' => 'GET'
        ]];

        return response()->json($exam, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $exam = Exam::find($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }

        if (!$exam) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        try {
            $exam->delete();
        } catch (\Exception $e) {
            // Log exception
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }

        $examInfo = new \stdClass();
        $examInfo->links = ['rel' => 'exams', 'href' => '/api/v1/exams', 'action' => 'GET'];
        $examInfo->msg = 'Exam deleted successfully';

        return response()->json($examInfo, 200);
    }
}

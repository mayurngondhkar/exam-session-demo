<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($examCode)
    {
        try {
            $exam = Exam::query()
                ->select('id', 'code', 'name', 'start_time', 'end_time')
                ->where('code', '=', $examCode)
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
            'href' => "/api/v1/exams/$examCode",
            'action' => 'PUT'
        ], [
            'ref' => 'exam',
            'href' => "/api/v1/exams/$examCode",
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

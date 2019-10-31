<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:exams|min:5|max:20',
            'name' => 'required|min:5|max:50',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $exam = new Exam([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        try {
            $exam->save();
        } catch (\Exception $e) {
            // Log exception
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }

        unset($exam['created_at']);
        unset($exam['updated_at']);
        $exam->msg = 'State created successfully';
        $exam['links'] = [[
            'ref' => 'exam',
            'href' => "/api/v1/exams/$exam->id",
            'action' => 'PUT'
        ], [
            'ref' => 'exam',
            'href' => "/api/v1/exams/$exam->id",
            'action' => 'DELETE'
        ], [
            'rel' => 'exams',
            'href' => '/api/v1/exams',
            'action' => 'GET'
        ]];
        return response()->json($exam, 200);
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        try {
            $exam = Exam::find($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }

        if(!$exam) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $this->validate($request, [
            'name' => 'required|min:5|max:50',
        ]);

        $exam->code = $request->input('code');
        $exam->name = $request->input('name');
        $exam->start_time = $request->input('start_time');
        $exam->end_time = $request->input('end_time');

        try {
            $exam->save();
        } catch (\Exception $e) {
            // Log exception
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }

        unset($exam['created_at']);
        unset($exam['updated_at']);
        unset($exam['deleted_at']);

        $exam->msg = 'State Updated';
        $exam['links'] = [[
            'ref' => 'exam',
            'href' => "/api/v1/exams/$id",
            'action' => 'PUT'
        ], [
            'ref' => 'exam',
            'href' => "/api/v1/exams/$id",
            'action' => 'DELETE'
        ], [
            'rel' => 'exams',
            'href' => '/api/v1/exams',
            'action' => 'GET'
        ]];
        return response()->json($exam, 200);
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

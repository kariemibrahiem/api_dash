<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Attendance as ObjModel;
use Illuminate\Http\Request;

class AttendanceApiService extends \App\Services\BaseService
{

    public function __construct(ObjModel $model)
    {
        parent::__construct($model);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attends = ObjModel::all();
        return response()->json([
            "status" => 200,
            "message" => "success",
            "data"=> $attends
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $data["login_at"] = now();
        $model = $this->createData($data);
        if ($model) {
            return response()->json([
                'status' => 200,
                "message" => "success"
                ]);
        } else {
            return response()->json([
                'status' => 405,
                "message" => "failed"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update($data, Attendance $attendance)
    {

        $data["logout_at"] = now();
//        $data["attend_time"] = $attendance->logout_at->diffInMinutes($attendance->login_at);
        $data["attend_time"] = $this->getTimeDifferenceAsTime($attendance->login_at, $attendance->logout_at);
        $attend = $this->updateData($attendance->id, $data);

        if ($attend) {
            return response()->json([
                'status' => 200,
                "message" => "success"
                ]);
        } else {
            return response()->json([
                'status' => 405,
                "message" => "failed"
            ]);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

}

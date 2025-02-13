<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceApiRequest;
use App\Models\Attendance;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use App\Services\AttendanceApiService;


class AttendanceController extends Controller
{
    use PhotoTrait;
    public function __construct(protected Attendance $model , protected AttendanceApiService $attendService)
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->attendService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceApiRequest $request)
    {
        $data = $request->validated();
        if ($request->photo){
            $data["photo"] = $this->saveImage($request->photo , 'attendances/'. $request->user_id);
        }
        return $this->attendService->store($data);
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
    public function update(Request $request, $id )
    {
        $attendance = $this->model->find($id);
//        if ($request->photo){
//            $request->photo = $this->saveImage($request->photo , 'attendances/'. $request->user_id);
//        }
        return $this->attendService->update($request->all() , $attendance);

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

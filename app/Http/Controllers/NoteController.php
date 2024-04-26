<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes=Note::all();
        return response()->json(
            [
                'notes'=>$notes
            ],200

        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function DepartmentNote(Request $request)
    {
        DB::beginTransaction();
        try {
            $department=Department::where('id',$request->department_id)->first();
            $department->notes()->create([
                'note'=>$request->note,
            ]);
            $note=$department->notes()->get('note');
            DB::commit();
            return response()->json(
                [
                    'message'=>'Note Added Successfully',
                    'nots'=>$note

                ],200

            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'message'=>'Note Not Added',
                    'error'=>$e->getMessage()

                ],400

            );
        }
    }




    public function EmployeeNote(Request $request)
    {
        DB::beginTransaction();
        try {
            $employee=Employee::where('id',$request->employee_id)->first();
            $employee->notes()->create([
                'note'=>$request->note,
            ]);
            $note=$employee->notes()->get('note');
            DB::commit();
            return response()->json(
                [
                    'message'=>'Note Added Successfully',
                    'nots'=>$note

                ],200

            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'message'=>'Note Not Added',
                    'error'=>$e->getMessage()

                ],400

            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

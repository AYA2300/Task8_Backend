<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddDepartment;
use App\Http\Requests\UpdateDepartment;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments=Department::all();

        return response()->json([
            'Departments'=> $departments
        ]

        );    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddDepartment $request)
    {
        DB::beginTransaction();
        try{
            $department=Department::create([
                'name'=>$request->name,
                'description'=>$request->description,
            ]);
            DB::commit();
            return response()->json([
                'message'=>'Department created successfully',
                'department'=>$department
            ]);
        }
        catch(Throwable $e){
            DB::rollBack();
            Log::error($e ->getMessage());
            return response()->json([
                'message'=>'Something went wrong'
            ],500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Department $id)
    {
        $employees=$id->employees()->get('first_name');
        return response()->json([
            'department'=>$id,
            'employees'=>$employees
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartment $request, Department $department)
    {
        DB::beginTransaction();
        $DrpartmentData=[];
        try{
            if(isset($request->name)){
                $DrpartmentData['name'] = $request->name;

            }
            if(isset($request->description)){
                $DrpartmentData['description'] = $request->description;

            }


            $department->update($DrpartmentData);
            DB::commit();

            return response()->json([
                'msg'=>'Drpartment Updated Successfully',
                'Drpartment'=>$DrpartmentData,



            ]);
    }
    catch(Throwable $e){
        DB::rollBack();
        Log::error($e->getMessage());
        return response()->json([
            'msg'=>'Department Not Updated',
            'error'=>$e->getMessage()
        ]);
    }
    }



    public function restore()
    {
        $department= Department::onlyTrashed()->restore();
        return response()->json([
        'department'=> $department]);
    }

    public function deletePermanently()
    {

        Department::onlyTrashed()->forceDelete();
        return response()->json([
            'msg'=>'Department Deleted Successfully',

        ]);

    }

    public function Trash()
    {

       $department= Department::onlyTrashed()->get();
       return response()->json([
           'Trashed_department'=>$department
       ]);

    }



    public function delete(Department $id){

        $id->delete();
        return response()->json([
            'msg'=>'Department Deleted Successfully',


        ]);

    }
}




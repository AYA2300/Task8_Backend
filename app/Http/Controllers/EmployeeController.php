<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEmployee;
use App\Http\Requests\UpdateEmployee;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees=Employee::all();
        foreach ($employees as $employee){
           Log::debug( $employee->first_name);}



        return response()->json([
            'message'=>'List of Employees',
            'employees'=>$employees

        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddEmployee $request)
    {
        try{
            DB::beginTransaction();

            $employee=Employee::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'position'=>$request->position,
                'department_id'=>$request->department_id,


            ]);

            DB::commit();
            return response()->json([
                'msg'=>'Employee Created Successfully',
                'Employee'=>$employee


            ]);
        }
        catch(Throwable $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'msg'=>'Employee Not Created',
                'error'=>$e->getMessage()
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $id)

    {
        $department=$id->department()->get('department');
        return response()->json([
            'msg'=>'Employee Details',
            'Employee'=>$id,
            'Department'=>$department

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployee $request, Employee $employee)
    {
        DB::beginTransaction();
        $EmployeeData=[];
        try{
            if(isset($request->first_name)){
                $EmployeeData['first_name'] = $request->first_name;

            }
            if(isset($request->last_name)){
                $EmployeeData['last_name'] = $request->last_name;

            }
            if(isset($request->position)){
                $EmployeeData['position'] = $request->position;

            }
            if(isset($request->department_id)){
                $EmployeeData['department_id'] = $request->department_id;

            }

            $employee->update($EmployeeData);
            DB::commit();

            return response()->json([
                'msg'=>'Employee Updated Successfully',
                'Employee'=>$employee,



            ]);
    }
    catch(Throwable $e){
        DB::rollBack();
        Log::error($e->getMessage());
        return response()->json([
            'msg'=>'Employee Not Updated',
            'error'=>$e->getMessage()
        ]);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore()
    {
        $employee=Employee::onlyTrashed()->restore();
        return response()->json([
            'employee'=> $employee]);
    }

    public function deletePermanently ()
    {

        Employee::onlyTrashed()->forceDelete();
        return response()->json([
            'msg'=> 'Deleted Successfully']);

    }

    public function Trash()
    {

       $employee= Employee::withTrashed()->get();
        return response()->json([
            'employee'=> $employee]);

    }

    public function delete(Employee $id){

        $id->delete();
        return response()->json([
            'msg'=>'Employee Deleted Successfully',
            'Employee'=>$id

        ]);

    }
}

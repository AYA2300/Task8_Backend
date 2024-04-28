<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProject $request)
    {


        try{
            DB::beginTransaction();
            $project=Project::create([
                'title'=>$request->title,
                'link'=>$request->link,
                'image'=>$request->file('image')->store('images'),


            ]);
            DB::commit();
            $project->employees()->attach($request->employee_id);

            return response()->json([
                'msg'=>'Project Created Successfully',
                'Project'=>$project,



            ]);
        }
        catch(Throwable $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'msg'=>'Project Not Created',
                'error'=>$e->getMessage()
            ]);
    }
    }
    /**
     * Display the specified resource.
     */
    public function show(Project $id)
    {
        $Employee=$id->employees()->get(['first_name']);
        return response()->json([
            'msg'=>'Project Details',
            'Employee'=>$Employee,
            'Project'=>$id

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}

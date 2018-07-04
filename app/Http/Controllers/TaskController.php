<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Label;
use Carbon\Carbon;
use DB;

class TaskController extends Controller
{
    public function index()
    {
        $labels = Label::getLabels();
        return view('task.create',compact('labels'));
    }

    public function create(Request $request)
    {      
        $task=Task::Create([
            'user_id'=>auth()->id(), 
            'task'=> request('task'),
            'description'=>request('description'),
            'due'=>request('due'),
            'label'=>"Pivot",
            'priority'=>request('priority'),
            'status'=>request('status')
        ]);
        $labelIds = $request->input('label');
        
        $task->labels()->attach($labelIds);
        return redirect()->home();
    }

    public function showOne(Task $task){
        if ($task->priority==0)
            $priority="Normal";
        else
            $priority="Urgent";

        return view('task.showOne',compact('task','priority','status'));
    }

    public function edit(Task $task)
    {
        $labels = Label::getLabels();
        if($task->status==0)
            return view('task.edit',compact('task','labels'));
        else
            return back();
    }

    public function save(Task $task)
    {
        
        $task->description=request('description');
        $task->due=request('due');
        $task->label=request('label');
        $task->priority=request('priority');
        $task->status=request('status');
        $task->save();
        if ($task->priority==0)
            $priority="Normal";
        else
            $priority="Urgent";

        if ($task->status==0)
            $status="Not completed";
        else
            $status="Completed";
    
        return view('task.showOne',compact('task','priority','status'));
    }

    public function search(){
        $val=request('val');
        $searchedTasks= Task::where('task','LIKE','%'.$val.'%')->orWhere('description','LIKE','%'.$val.'%')->get();

        return response()->json(array('msg'=> $searchedTasks), 200);
    }

    public function myday(){
        $tasks=Task::sortedByMyDay();
        return view('home',compact('tasks'));
    }

    public function time(){
        $labels = Label::getLabels();
        $tasks=Task::sortedByTime();
        return view('home',compact('tasks','labels'));
    }    

    public function pin(Task $task){
        $task->pin=!$task->pin;
        $task->save();
        return back();
    }

    public function status(Task $task)
    {
        $task->status=!$task->status;
        $task->save();
        return back();
    }

    public function archive(Task $task){
        $task->archived=1;
        $task->save();
        return back();
    }

    public function unarchive(Task $task){
        $task->archived=0;
        $task->save();
        return back();
    }

    public function delete(Task $task){
        $task->deleted=1;
        $task->save();
        return back();
    }

    public function restore(Task $task){
        $task->deleted=0;
        $task->save();
        return back();
    }

    public function deletecompletely(Task $task){
        Task::find($task->id)->delete();
        
        return back();
    }

    public function archivedtasks(){
        $tasks = Task::getArchived();
        return view('task.archive',compact('tasks'));
    }

    public function deletedtasks(){
        $tasks = Task::getDeleted();
        return view('task.bin',compact('tasks'));
    }

    public function removeLabel(Task $task, $lab){
        
        $label = Label::where('label',$lab)->first();

        $task->labels()->detach($label->id);
        
        return response()->json(array("msg","success"),200);
    }

    public function deleteTrashed(){
        $tasks = Task::where('deleted','=','1')
                ->get();
        
        
        foreach($tasks as $task){
            $d = $task->updated_at->toDateString();
            $date = Carbon::parse($d);
            $today = Carbon::today(); 
            if(($today->diff($date))->format('%a')>=7){
                $task->delete();
            }
        }
    
    }
}

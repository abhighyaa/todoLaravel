<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Label;
use App\Task;
use DB;

class LabelController extends Controller
{
    //
    public function create(User $user){
        return view('labels.create',compact('user'));
    }

    public function save(Request $request){

        $label = Label::Create([
            'user_id'=>auth()->id(), 
            'label'=> request('label'),
        ]);
        
        if($request->hasFile('image')){
            $path = $request->file('image')->storeAs(
                'uploads/labels', $label->id
            );
            // $path = $request->photo->storeAs('images', 'filename.jpg');
        
            $label->image=$path;
            $label->save();
            
        }
        return redirect()->home();
    }
    
    public function edit(){
        $labels = Label::getLabels();
        return view('labels.edit',compact('labels'));
    }

    public function delete(Request $request){
        $label = request('label');
        $findLabel = Label::where('label','=',$label)->get();
        $tasks = Task::where('label','=',$label)->get();
        foreach ($tasks as $task){
            $task->label = "Default";
            $task->save();
        }
        $deleted = Label::where('label', '=',$label)->delete();
        return response()->json(array("msg","success"),200);
    }

    public function changeLabel(Request $request){
        $label = request('label');
        $newlabel = request('newlabel');
        $tasks = Task::where('label','=',$label)->get();
        foreach ($tasks as $task){
            $task->label = $newlabel;
            $task->save();
        }
        $find = Label::where('label','=',$label)->first();
        
            $find->label = $newlabel;
            $find->save();
        
        return response()->json(array("msg",$find),200);    
    }

    public function show(Label $label){
        $labelname = $label->label;
        $labels = Label::getLabels();
        //$ids = DB::table('label_task')->where('label_id','=',$label->id)->get();
        // dd($ids);
        // $tasks = Task::whereHas('taglabelss', function($query) use ($labelLabel) {
        //     $query->whereName($labelLabel);
        //   })->get();
        
            $tasks= Label::find($label->id)->tasks;
          
        return view('labels.show',compact('tasks','labelname','labels'));
    }

    public function addLabel($id,Task $task){
    
        $task->labels()->attach($id);
        return response()->json(array("msg","success"),200); 
    }
}

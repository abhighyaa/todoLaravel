<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use  Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Task;
use Carbon\Carbon;
use App\Label;
use App\Notification;
use App\Notifications\OverdueTask;
use App\Notifications\Reminder;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user()->id;
        
        $tasks = Task::getTasks();
        $labels = Label::getLabels();
        $found=0;
        return view('home',compact('tasks','labels','found'));
    }

    public function edit()
    {
        if($user = Auth::user())
        {
            return view('editprofile');
        }
        else{
            return back();
        }
    }

    public function saveedit(Request $request)
    {
        if($request->hasFile('avatar')){
            // return "hi";
            $user=Auth::user();
            // $file =Input::file('avatar');
            //$destination = public_path('uploads/'.$user->name);
            $path = $request->file('avatar')->storeAs(
                'uploads', $user->id
            );
            Storage::setVisibility($path, 'public');
            $user->avatar=$path;
            $user->save();
            
        }
        $tasks = Task::getTasks();
        $labels = Label::getLabels();
        return view('home',compact('tasks','labels'));
    }

    public function notify(){
        // $tasks = Task::all();
        // if (!empty($tasks)){
        //     $notifications = Notification::all();
        //     foreach ($tasks as $task){
        //         $date = Carbon::parse($task->due);
        //         $reminder = Carbon::parse($task->reminder)->format('Y-m-d H:i');
        //         $now = Carbon::now()->format('Y-m-d H:i');
        //         //dd($now);
        //         if ($date->isPast()){
        //             if(count($notifications)){
        //                 foreach ($notifications as $notification){
        //                     if(Auth::user()->id != $notification->notifiable_id && $notification->data['id']!= $task->id && $notification->notifiable_type != "App\Notifications\OverdueTask")
        //                         Auth::user()->notify(new OverdueTask($task));
                            
        //                 }
        //              }
        //         //     else{
        //         //         Auth::user()->notify(new OverdueTask($task));
        //         //     }
        //         }
        //         if($reminder==$now){
        //             Auth::user()->notify(new Reminder($task));
        //         }

        //     }
        // }
        $notifications = Auth::user()->unreadNotifications;
        return view('notifications.notification',compact('notifications'));
    }

    public function readnotify()
    {
        $user =  Auth::user();
        $user->notifications->map(function($n){
            //$user->unreadNotifications()->update(['read_at' => now()]);
            $n->markAsRead();
        });
        return response()->json(array("msg","success"),200);
    }

    public function myorder(){
        $i = 0;

        foreach ($_POST['item'] as $value) {
            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            $i++;
            DB::table('tasks')->where('id', '=', $value)->update([ 'myorder' => $i ]);
        }
    }

    public function scheduleNotifications(){
        $tasks = Task::all();
        if (!empty($tasks)){
            $notifications = Notification::all();
            foreach ($tasks as $task){
                
                $now = Carbon::now()->format('Y-m-d H:i');
            
                $date = Carbon::parse($task->due);
                $user = $task->user;
                if ($date->isPast()){
                    $user->notify(new OverdueTask($task));
                }
                if($task->reminder!=Null){
                    $reminder = Carbon::parse($task->reminder)->format('Y-m-d H:i');
                    if($reminder===$now){
                        $user->notify(new Reminder($task));
                    }
                }

            }
        }
        
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class Task extends Model
{
    protected $fillable = ['user_id','task','description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class)->withTimestamps();
    }

    static public function getTasks(){
        return static::where('user_id', '=', Auth::user()->id)
                        ->where('archived','=','0')
                        ->where('deleted','=','0')
                        ->orderBy('status','ASC')
                        ->orderBy('pin','DESC')
                        ->orderBy('priority','DESC')
                        ->get();
    }

    static public function sortedByMyDay(){
        return static::where('user_id', '=', Auth::user()->id)
                        ->whereDate('due','=',Carbon::today()->format('Y-m-d'))
                        ->get();
    }

    static public function sortedByTime(){
        return static::where('user_id', '=', Auth::user()->id)
                        ->orderBy('created_at','ASC')
                        ->get();
    }

    static public function getArchived(){
        return static::where('user_id', '=', Auth::user()->id)
                        ->where('archived','=','1')
                        ->where('deleted','=','0')
                        ->orderBy('pin','DESC')
                        ->orderBy('priority','DESC')
                        ->orderBy('status','ASC')
                        ->get();
    }

    static public function getDeleted(){
        return static::where('user_id', '=', Auth::user()->id)
                        ->where('deleted','=','1')
                        ->orderBy('updated_at','DESC')
                        ->get();
                        
    }
}

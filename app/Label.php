<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Task;

class Label extends Model
{
    protected $fillable = ['user_id','label'];

    public function tasks(){
        return $this->belongsToMany(Task::class);
    }

    static public function getLabels(){
        return static::where('user_id', '=', Auth::user()->id)
                ->get();
    }
}

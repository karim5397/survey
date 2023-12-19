<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'entry_id','question_id','value'
    ] ;
    public function entry(){
        return $this->belongsTo(Entry::class,'entry_id','id');
    }
    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }
}

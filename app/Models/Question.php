<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'questionnaire_id',
        'order',
        'content',
        'type',
        'options',
        'rules',
        'is_required',
    ];
    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class,'questionnaire_id','id');
    }
    public function answers(){
        return $this->hasMany(Answer::class,'question_id','id');
    }
}

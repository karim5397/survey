<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_active',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function questions(){
        return $this->hasMany(Question::class,'questionnaire_id','id');
    }
    public function entries(){
        return $this->hasMany(Entry::class,'questionnaire_id','id');
    }
}

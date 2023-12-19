<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MattDaneshvar\Survey\Models\Survey;

class SurveyController extends Controller
{
    public function index(){
        $surveys = Survey::orderBy("id","desc")->paginate(10);
    }
    public function create(){
        $survey = Survey::create(['name' => 'Cat Population Survey']);
    }
}

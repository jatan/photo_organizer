<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('home')->with([
            'frame_status'  => Answer::getFrameStatus(),
            'photo_types'   => Answer::getPhototypes(),
            'people'        => Answer::getPeople(),
        ]);
    }

    public function processForm(Request $request)
    {
        $validatedData = $request->validate([
            'people'=>'required']);
        $answer = new Answer();
        $answer['user_id'] = Auth::user()->id;
        $answer['frame_status'] = $_POST['frame_status'];
        $answer['photo_type'] = $_POST['photo_type'];
        foreach ($_POST['people'] as $key => $value) {
            $answer[$value] = 1;
        }
        $answer->save();
        return redirect(route('home'));
    }
/*
    public function calculate(Request $request)
    {
        $answer = new Answer();
        $result = $answer->getCountOfPics($request);
        return $result; // This will dump and die
    }*/
}

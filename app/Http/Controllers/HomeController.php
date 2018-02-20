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
     * Show the application Home Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // generating history
        $data = DB::Table('answers')
            -> where('user_Id','=',Auth::user()->id)
            ->get();
        $history = json_decode($data,1);
        foreach ($history as $key => $value) {
            $history[$key]['frame_status'] = Answer::getFrameValue($value['frame_status']);
            $history[$key]['photo_type'] = Answer::getPhotoTypesValue($value['photo_type']);
        }

        return view('home')->with([
            'frame_status'  => Answer::getFrameStatus(),
            'photo_types'   => Answer::getPhototypes(),
            'people'        => Answer::getPeople(),
            'history'       => $history

        ]);
    }

    /**
     * Process Submission From Form
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Calculation of AJAX call 
     *
     * @return Integer
     */
    public function calculate(Request $request)
    {
        $answer = new Answer();
        $result = $answer->getCountOfPics($request);
        return $result;
    }
}

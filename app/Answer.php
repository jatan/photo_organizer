<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Answer extends Model
{
    protected $table = 'answers';


    // Static Array to store all types of Frame Status
	protected static $frameStatus = [
	    '0' => 'digital',
	    '1' => 'Wooden',
	    '2' => 'Metal',
	    '3' => 'Printed Only'
	];

    // Static Array to store all types of Phto Types
	protected static $photoType = [
		'0' => 'Selfie',
		'1' => 'Regular',
		'2' => 'Panorama',
		'3' => 'Portrait',
		'4' => 'Downloaded'
	];

    // Static Array to store all different people
	protected static $people =[
		'me' 		=> 'Me',
		'wife' 		=> 'Wife',
		'kids' 		=> 'kids',
		'parents' 	=> 'Parents',
		'pets' 		=> 'Pets',
		'food' 		=> 'Food',
		'randoms' 	=> 'Randoms'
	];
	
	//relation ship with User 
    public function givenBy() {
		return $this->belongsTo('\user', 'user_id');
	}

	// Static Method to access all Frame Status
	public static function getFrameStatus(){
		return self::$frameStatus;
	}

	public static function getFrameValue($index)
	{
		if($index < count(self::$frameStatus))
			return (self::$frameStatus[$index]);
	}

	// Static Method to access all photo Types
	public static function getPhotoTypes(){
		return self::$photoType;
	}

	public static function getPhotoTypesValue($index)
	{
		if($index < count(self::$photoType))
			return (self::$photoType[$index]);
	}

	// Static Method to access all photo Types
	public static function getPeopleValue($index)
	{
		if($index < count(self::$people))
			return (self::$people[$index]);
	}

	public static function getPeople(){
		return self::$people;
	}

	public function getCountOfPics($query=null)
	{
			$raw='';
		if($query['people'] == null){
			$result = $this->where('user_id',Auth::user()->id)->count();
		}
		else{
			foreach ($query['people'] as $people) {
				$raw .= $people ."=1"; 
				if($people != $query['people'][count($query['people'])-1])
					$raw .= " AND ";
			}
			$result = $this->whereRaw($raw)->where('user_id',Auth::user()->id)->count();
		}

		return $result;
	}

	//Seeder Calls this Method to add Dummy records
	public function generateAnswers()
	{
		DB::table('answers')->insert([
	            'user_id' => 1,
	            'frame_status' => random_int(0, count(self::$frameStatus)-1),
	            'photo_type' => random_int(0, count(self::$photoType)-1),
	            'me' => rand(0,1),
	            'wife' => rand(0,1),
	            'kids' => rand(0,1),
	            'parents' => rand(0,1),
	            'pets' => rand(0,1),
	            'food' => rand(0,1),
	            'randoms' => rand(0,1)
	        ]);
	}

	
    public function calculate(Request $request)
    {
        $answer = new answers();
        $result = $answer->getCountOfPics($request);
        return $result; // This will dump and die
    }

}

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

	// Logic To Calculate Number Of Pics for the user for give selecetion
	public function getCountOfPics($input=null)
	{
		$query = DB::table('answers')->where('user_id','=',Auth::user()->id);

		if(isset($input['people'])){
			foreach ($input['people'] as $people) {
				$query->where($people,'=','1');
			}
		}

		if($input['frame_status']!="blank"){
			$query->where('frame_status','=',$input['frame_status']);
		}

		if($input['photo_type']!="blank"){
			$query->where('photo_type','=',$input['photo_type']);
		}

		$result = $query->count();
		return $result;
	}

	//Seeder Calls this Method to add Dummy records
	public function generateAnswers()
	{
		DB::table('answers')->insert([
	            'user_id' => 1, // USER_ID : 1 = test@gmail.com
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
}

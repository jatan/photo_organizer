<?php

use Illuminate\Database\Seeder;
use App\Answer;
class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answer = new Answer();
        for ($i=0; $i < 50; $i++) { 
	        $answer->generateAnswers();
        }
    }
}

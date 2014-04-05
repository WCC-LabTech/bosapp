<?php 

namespace Lotto\models;

use Eloquent, Validaton, Exception;



class Course extends Eloquent {

	protected $table = 'schedule_course';
	public $timestamps = true;
    protected $softDelete = true;

	protected $fillable = array('building', 'course_number', 'course_title', 'creditHour', 'crn',
	 'days_of_week', 'end_date', 'end_time', 'instructor', 'part_of_term','room_number',
      'section', 'start_date', 'start_time', 'subject_code', 'term_code');
	

    protected $guarded = array('id');
    protected $hidden = array('pivot');

	private static $rules = array(
		'creditHour' => 'required|numeric',
		'crn' => 'required|alpha_num',
		'daysInWeek' => 'alpha',
		'endDate' => 'date',
		//'endTime' => 'time',
		//'name' => 'required|alpha_num',
		'startDate' => 'date',
		'startTime' => 'time',
		//'labAide' => 'numeric|exists:auth_user,id',
		//'instructor' => 'numeric|exists:auth_user,id'
	);

    private static $updateRules = array(
        'id' => 'required|numeric|exists:lotto_course,id',
        'creditHour' => 'numeric',
        'crn' => 'alpha_num',
        'daysInWeek' => 'alpha',
        'endDate' => 'date',
        //'endTime' => 'time',
        //'name' => 'required|alpha_num',
        'startDate' => 'date',
        'startTime' => 'time',
        'labAide' => 'numeric|exists:global_user,id'
    );

	public static function validate($data){
		return Validator::make($data, static::$rules);
	}

    public static function updateValidate($data){
        return Validator::make($data, static::$updateRules);
    }

	public static function boot(){
        parent::boot();

        Course::created(function($course){
           	try{
                // Skill::create(array('name' => 'bob'));
        		Skill::where('name' ,'=' , $course->course_title)->firstOrFail();
        	}catch (Exception $e){
        		Skill::create(array('name' => $course->course_title));
        	}

        });

        Course::creating(function($course){
            
        });

        Course::deleting(function($course){
           
        });

    }

	public function labAides(){
        return $this->belongsToMany('User', 'lotto_course_labAide');
    }

    protected static function checkSkills($user, $course){
       
        if(in_array($course->name, $user->skills->fetch('name')->toarray()))
            return true;

    	throw new Exception("Missing required skill");
    }

    private static $labAide = 20;
    private $labTech = 20;

    protected static function checkTime($user, $course){
    	
        $time = $course->creditHour;

    	foreach ($user->courses as $anotherCourse){
    		$time += $anotherCourse['creditHour'];
    	}


    	
    	foreach ($user->staffTypes as $type){
           
    		switch($type['type']){

    			case 'labAide': if($time < Course::$labAide) return true;
    		}

    	}

		throw new Exception("Insufficient time.");
    }

	public static function checkUser($user, $course){

        if(! in_array( 'labAide', $user->staffTypes->fetch('type')->toarray() ) )
            throw new Exception("Invalid employee type");
		course::checkSkills($user, $course);		
		course::checkTime($user, $course);
		
		return true;
	}

}

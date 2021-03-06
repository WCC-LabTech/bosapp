<?php 
namespace Lotto\controllers;

use BaseController, Lotto\models\Course, Lotto\models\Skill, User;
use Input, Response, Redirect, Session, Exception;
use View;

class SkillController extends BaseController {



	/*
	|--------------------------------------------------------------------------
	| Controller Views
	|--------------------------------------------------------------------------
	*/

	/*	
		URL: /admin/schedule/skill/assign-skills?id=#

		Get user id from input
		

		-- 

		Data sent to view:

		All skills but the ones the users has.

		The user.

		Any session data passed along from redirects.


		If any error - return a problem message....

	*/


	



	/*
	|--------------------------------------------------------------------------
	| Controller Posts
	|--------------------------------------------------------------------------
	*/

	public function postRemoveUserSkill(){
		
			$userId = Input::get('user');
			$skillId = Input::get('skill');

		try{
			
			User::findorFail($userId)->skills()->detach($skillId);

	
		} catch(exception $e){
			return Redirect::to('admin/schedule/modify-user?id=' . $userId)->with( 
			array( 
			'message' => 'failed to remove skill',
			//'message' => $e->getMessage()
			));
		}


		return Redirect::to('admin/schedule/modify-user?id=' . $userId)->with( 
			array(
			'message' => 'removed skill'
			));
	}


	/*
		attaches a skill to the user.

		takes id for user and id for a skill.

	*/

	public function postSetUserSkill(){
		$userId = Input::get('user');
		$skill = Input::get('skill');
		



		try{

			User::findOrFail($userId)->skills()->attach($skill);


		} catch(exception $e){
			return Redirect::to('admin/schedule/modify-user?id=' . $userId)->with( 
			array( 
			'message' => 'failed to assign skill'
			));
		}

		
		return Redirect::to('admin/schedule/modify-user?id=' . $userId)->with( 
			array('status' => 200, 
			'message' => 'assigned skill'
			));
	}


	public function missingMethod($parameters = array())
	{
		return Response::json(array('status' => 404, 'message' => 'Not found'), 404);
	}
}


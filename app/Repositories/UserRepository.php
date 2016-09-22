<?php namespace App\Repositories;

use App\User;

class UserRepository {


	public function getUserDetailByID($id)
	{
		return User::find($id);

	}


	public function getUserDetailByToken($id, $token)
	{
		return User::where('id', $id)->where('api_token', $token)->first();
	}





}
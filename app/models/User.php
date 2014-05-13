<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $fillable = array('email', 'first_name', 'last_name', 'mobile_number');
	protected $guarded = array('id', 'password', 'password_salt', 'privilege_id', 'locked_out', 'attempts', 'default_servergroup');
	public $timestamps = false;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	 /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
    }

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

	public function setPasswordAttribute($pass){
		$this->attributes['password'] = Hash::make($pass);
	}

    public function subscription()
    {
    	return $this->hasMany('Subscription', 'user_id', 'id');
    }
}
<?php

class Pulse extends Eloquent {

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = array('ram_usage', 'cpu_usage', 'disk_usage', 'uptime', 'timestamp');
	protected $guarded = array('id', 'server_id');
	public $timestamps = false;

	/**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
    }
}
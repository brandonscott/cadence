<?php
    class Privilege extends Eloquent {

    	/**
    	 * The attributes excluded from the model's JSON form.
    	 *
    	 * @var array
    	 */
    	protected $fillable = array('name');
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
?>
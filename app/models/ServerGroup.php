<?php
    class ServerGroup extends Eloquent {
    	/**
    	 * The attributes excluded from the model's JSON form.
    	 *
    	 * @var array
    	 */
        protected $table = "servergroups";
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

        public function server()
        {
        	return $this->hasMany('Server', 'servergroup_id', 'id');
        }
    }
?>
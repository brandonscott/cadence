<?php
    class Server extends Eloquent {

    	/**
    	 * The attributes excluded from the model's JSON form.
    	 *
    	 * @var array
    	 */
    	protected $fillable = array('servergroup_id', 'name', 'available_disk', 'available_ram', 'cpu_speed', 'os_name', 'os_version');
    	protected $guarded = array('id', 'guid');
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

        public function pulse()
        {
        	return $this->hasMany('Pulse', 'server_id', 'id');
        }

        public function scopeOfUnassigned($query, $status)
        {
            return $query->where('servergroup_id', '=', $status);
        }

        public function scopeofAssigned($query, $status)
        {
            return $query->where('servergroup_id', '>', $status);
        }

        public function scopeOfStatus($query, $status)
        {
            return $query->where('online', '=', $status);
        }
    }
?>
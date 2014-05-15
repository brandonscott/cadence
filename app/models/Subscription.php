<?php
    class Subscription extends Eloquent {

    	/**
    	 * The attributes excluded from the model's JSON form.
    	 *
    	 * @var array
    	 */
    	protected $fillable = array('user_id', 'phonecall', 'text', 'push');
    	protected $guarded = array('id', 'servergroup_id');
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

        public function deleteServerGroup($id)
        {
            $serverGroup = ServerGroup::find($id);
            $serverGroup->delete();

            return Response::json(array("success" => true));
        }

        public function serverGroup()
        {
            return $this->hasOne('ServerGroup', 'id', 'servergroup_id');
        }

        public function user()
        {
            return $this->hasOne('User', 'id', 'user_id');
        }

        public function scopeOfUser($query, $user_id)
        {
            return $query->where('user_id', '=', $user_id);
        }

        public function scopeOfServerID($query, $id)
        {
            return $query->where('servergroup_id', '=', $id);
        }
    }
?>
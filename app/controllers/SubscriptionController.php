<?php
	class SubscriptionController extends BaseController{
		
		public function getAll()
		{
			return Response::json(Subscription::all());
		}

		public function store()
		{
			$subscription = new Subscription;
			$subscription->servergroup_id = Input::get('servergroup_id');
			$subscription->user_id = Input::get('user_id');
			$subscription->phonecall = Input::get('phonecall');
			$subscription->text = Input::get('text');
			$subscription->push = Input::get('push');

			$subscription->save();

			return Response::json($subscription);
		}

		public function updateSubscription($id)
		{
			$subscription = Subscription::find($id);
			$subscription->text = Input::get('text');
			$subscription->phonecall = Input::get('phonecall');
			$subscription->save();

			return Response::json($subscription);
		}

		public function deleteSubscription($id)
        {
            $subscription = Subscription::find($id);
            $subscription->delete();

            return Response::json(array("success" => true));
        }
	}
?>
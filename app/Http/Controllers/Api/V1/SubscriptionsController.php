<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;
use Illuminate\Support\Str;

class SubscriptionsController extends Controller
{
    /**Add subscriber to a website
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSubscriberToWebsite(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'website_id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }
        $name = $request->name;
        $email = $request->email;
        $website_id = (int) $request->website_id;
        //be sure that this email has not subscribed to this website before
        $subscriber_check = Subscription::where('email', $email)
                            ->where('website_id', $website_id)
                            ->first();
        if($subscriber_check){
            //check if currently unsubscribed
            if($subscriber_check->subscribed == 0){
                $subscriber_check->subscribed = 1;
                $subscriber_check->save();
                return $this->successResponse($subscriber_check, 'User has been subscribed', 200);
            }else{
                return $this->errorResponse('User has already subscribed', 400);
            }

        }else{
            //add subscriber
            $susbcriberModel = new Subscription();
            $susbcriberModel->name = $name;
            $susbcriberModel->email = $email;
            $susbcriberModel->website_id = $website_id;
            $susbcriberModel->hash = Str::random(40);
            $susbcriberModel->save();
            return $this->successResponse($susbcriberModel, 'User subscribed successfully', 200);
        }
    }
}

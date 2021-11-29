<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsitesController extends Controller
{
    /**Function to create a website
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function createWebsite(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i']
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        $name = $request->name;
        $url = $request->url;
        $websiteModel = new Website();
        $websiteModel->name = $name;
        $websiteModel->url = $url;
        $websiteModel->save();
        return $this->successResponse($websiteModel, 'Website created successfully', 200);
    }

}

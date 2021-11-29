<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Website;

class PostsController extends Controller
{
    /**Create a post for a website
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description'=> ['required', 'string'],
            'website_id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }
        $title = $request->title;
        $description = $request->description;
        $website_id = (int) $request->website_id;
        //check if website exists
        $website_check = Website::find($website_id);
        if(!$website_check){
            return $this->errorResponse('Website not found', 404);
        }
        $postModel = new Post();
        $postModel->title = $title;
        $postModel->description = $description;
        $postModel->website_id = $website_id;
        $postModel->save();
        return $this->successResponse($postModel, 'Post created successfully', 200);
    }

}

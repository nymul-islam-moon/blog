<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController as Controller;
use Validator;
use Image;
use App\Http\Resources\BlogCategoryResource;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $blogCategories = BlogCategory::all();
    
        $responseMessage = 'Blog categories retrieved successfully';
        $resourceCollection = BlogCategoryResource::collection( $blogCategories );
    
        return $this->sendResponse( $resourceCollection, $responseMessage );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'name' => 'required',
                'status' => 'required',
                'image' => 'required',
            ]);
    
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
    
            $formData = [
                'name' => $request->input('name'),
                'status' => $request->input('status') == 1,
            ];
    
            if ($request->hasFile('image')) {
                $image = Image::make($request->file('image'));
                $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                $destinationPath = public_path('uploads/blog/category/');
                $image->save($destinationPath . $imageName);
                $formData['image'] = $imageName;
            }
    
            $blogCategory = BlogCategory::create($formData);
    
            return $this->sendResponse(new BlogCategoryResource($blogCategory), 'Product created successfully.');
        } catch (\Exception $e) {
            // Handle the exception, logging the error message
            return $this->sendError('Error occurred.', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

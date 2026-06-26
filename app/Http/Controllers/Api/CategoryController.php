<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'success'=> true,
            'message'=>'Successfully',
            'data'=>$categories
        ],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> ' required|string|max:250',
            'description'=>'required|string|max:500'

        ]);
        if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>'Validation error',
            'errors'=>$validator->errors()
        ], Response::HTTP_BAD_REQUEST);
        }
        $categories = Category::create($validator->validated());
        return response()->json([
            'success'=>true,
            'message'=>'The Category has been created!',
            'data'=>$categories

        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::find($id);
        if(!$categories){
            return response()->json([
                'success'=>false,
                'message'=> 'Catgory id is not found',

            ],Response::HTTP_NOT_FOUND);
        }else{
            return response()->json([
            'success'=>true,
            'message'=>'Get category by id is successfully!',
            'data'=>$categories,


        ],Response::HTTP_OK);

        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validator = Validator::make($request->all(),[
            'name'=> ' required|string|max:250',
            'description'=>'required|string|max:500'

        ]);
        if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>'Validation error',
            'errors'=>$validator->errors()
        ], Response::HTTP_BAD_REQUEST);
        }
        $categories= Category::find($id);
        $categories->update($validator->validated());
        return response()->json([
            'success'=>true,
            'message'=>'The Category has been created!',
            'data'=>$categories

        ], Response::HTTP_OK);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return response()->json([
            'success'=>true,
            'message'=>'The category has been deleted!'

        ]);
    }
}

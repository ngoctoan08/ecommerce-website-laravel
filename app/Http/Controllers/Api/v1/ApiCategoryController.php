<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\Api\v1\CategoryResource;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ApiCategoryController extends Controller
{
    protected $category; //model category
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //ham khoi tao co tham so truyen vao la category
    public function __construct(Category $categoryModel)
    {
        $this->category = $categoryModel;
    }

    // [GET] /
    public function index()
    {
        // return Auth::user()->name;
        // $categories = $this->category->latest()->paginate(10); //ngay mooi nhat, phan trang 5 ban ghi
        $categories = $this->category->all(); //ngay mooi nhat, phan trang 5 ban ghi
        return response()->json([
            'data' => $categories,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // [POST] /
    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();
        $this->category->create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Data has been saved'
        ]);
    }

    // list trash
    // [GET] /trash
    public function trash()
    {
        // $categories = $this->category->latest()->paginate(10); //ngay mooi nhat, phan trang 5 ban ghi
        $categories = $this->category->onlyTrashed()->get();
        return response()->json([
            'data' => $categories,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //[GET] id
    public function show($id)
    {
        $category = $this->category->find($id);
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //[PUT] id

    public function update(CategoryFormRequest $request, $id)
    {
        $data = $request->validated();
        $this->category->find($id)->update([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'description' => $request->description,
            ]);
        // return ["result" => "Data has been updated"];
        return response()->json([
            'status' => 200,
            'message' => 'Data has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //[DELETE] id

    public function destroy($id)
    {
        $this->category->find($id)->delete();
        // return redirect(route('category.index')); //tro ve ham index category
        return response()->json([
            'status' => 200,
            'message' => 'Data has been deleted'
        ]);
    }

    /**
     * Remove multiple the specified resource from storage.
     *
     * @param  Request  $request array
     * @return \Illuminate\Http\Response
     */
    //[POST] multipleDelete

    public function multipleDelete(Request $request)
    {
        if($request->isMethod('POST')) {
            $this->category->whereIn('id', $request)->delete();
            return response()->json(['message' => 'Data has been deleted'], 202);
        }
        return response()->json(['message' => 'Data has not been delete. Try again'], 202);
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function fDelete($id)
    {
        try {
            $this->category->withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Data is not find'
            ]);
        }
        $this->category->withTrashed()->where('id', $id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been force deleted'
        ]);
    }

    /**
     * multiple Force delete the specified resource from storage.
     *
     * @param  Request  $request array
     * @return \Illuminate\Http\Response
     */
     //[POST] multiplefDelete
    public function multiplefDelete(Request $request)
    {
        if($request->isMethod('POST')) {
            $this->category->withTrashed()->whereIn('id', $request)->forceDelete();
            return response()->json(['message' => 'Data has been force deleted'], 202);
        }
        return response()->json(['message' => 'Data has not been force delete. Try again'], 202);
    }
    
    // [GET] /restore/{id}
    public function restore($id)
    {
        try {
            $this->category->withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Data is not find'
            ]);
        }
        $this->category->withTrashed()->where('id', $id)->restore();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been restored'
        ]);
    }

    /**
     * Restore multiple the specified resource from storage.
     *
     * @param  Request  $request array
     * @return \Illuminate\Http\Response
     */
    public function multipleRestore(Request $request)
    {
        if($request->isMethod('POST')) {
            $this->category->withTrashed()->whereIn('id', $request)->restore();
            return response()->json(['message' => 'Data has been restored'], 202);
        }
    } 
}
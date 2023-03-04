<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recursive;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    private $optionCategory;
    private $urlApi;
    public function __construct(Category $categoryModel, Recursive $recursive)
    {
        $this->category = $categoryModel;
        $this->optionCategory = $recursive;
        $this->urlApi = 'http://127.0.0.1:8001/api/v1/category/';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $option = $this->optionCategory->makeRecursive($this->category, '');
        $client = new Client();
        $request = $client->get($this->urlApi);
        $response = json_decode($request->getBody()->getContents());
        if($response->status == 200) {
            $categories = $response->data;
            // dd($categories);
            return view('admin.category.index')->with([
                    'option' => $option,
                    'categories' => $categories,
            ]); //truyen categories vao view index
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $client = new Client();
        // $request = $client->post('http://127.0.0.1:8001/api/v1/category', [
        //     'form_params' => [
        //         'parent_id' => $request->parent_id,
        //         'name' => $request->name,
        //         'slug' => Str::slug($request->name, '-'),
        //         'description' => $request->description,
        //     ]
        // ]);
        // // dd($request);

        // $response = json_decode($request->getBody()->getContents());
        // if($response->status == 201) {
        //     return redirect()->route('category.index')->with('alert', $response->message);
        // }
        // else {
        //     dd($response->message);
        //     return redirect()->route('category.index')->with('alert', $response->message);
        // }
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
        $client = new Client();
        $request = $client->get($this->urlApi.$id);
        $response = json_decode($request->getBody()->getContents());
        $category = $response->data;
        $option = $this->optionCategory->makeRecursive($this->category, $category->parent_id);
        // dd($categorie);
        return view('admin.category.edit')->with([
                'option' => $option,
                'category' => $category,
        ]); //truyen category vao view index
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
        $client = new Client();
        $request = $client->put($this->urlApi.$id, [
            'form_params' => [
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'description' => $request->description,
            ]
        ]);
        $response = json_decode($request->getBody()->getContents());
        // dd($response);
        if($response->status == 200) {
            return redirect()->route('category.edit', $id)->with('success', $response->message);
        }
        else {
            dd($response->message);
            return redirect()->route('category.edit', $id)->with('success', $response->message);
        }
    }


    // this function handle multiple action: delete, force delete, restore
    public function handleAction(Request $request)
    {
        $ids = $request->input('item'); // array
        $option = $request->input('option');
        switch ($option) {
            case 'delete':
                $client = new Client();
                $request = $client->post($this->urlApi.'multipleDelete', [
                    'form_params' => $ids
                ]);
                $response = json_decode($request->getBody()->getContents());
                return redirect()->back()->with('success', $response->message);
                break;

            case 'restore':
                $client = new Client();
                $request = $client->post($this->urlApi.'multipleRestore', [
                    'form_params' => $ids
                ]);
                $response = json_decode($request->getBody()->getContents());
                return redirect()->back()->with('success', $response->message);
                break;
            case 'f_delete':
                $client = new Client();
                $request = $client->post($this->urlApi.'multiplefDelete', [
                    'form_params' => $ids
                ]);
                $response = json_decode($request->getBody()->getContents());
                return redirect()->back()->with('success', $response->message);
                break;
            default:
                return redirect()->back()->with('error', "This action unavailable");
                break;
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {  
        $client = new Client();
        $request = $client->get($this->urlApi.'trash');
        $response = json_decode($request->getBody()->getContents());
        if($response->status == 200) {
            $categories = $response->data;
            // dd($categories);
            return view('admin.category.trash')->with([
                    'categories' => $categories,
            ]); //truyen categories vao view index
        }
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

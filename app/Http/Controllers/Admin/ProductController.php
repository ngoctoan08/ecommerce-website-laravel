<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Components\Recursive;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as RequestGuzzle;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;

class ProductController extends Controller
{
    private $product; //model product
    private $category;
    private $optionCategory;
    private $urlApi;

    //ham khoi tao co tham so truyen vao la product
    public function __construct(Product $productModel, Category $categoryModel, Recursive $recursive)
    {
        $this->product = $productModel;
        $this->category = $categoryModel;
        $this->optionCategory = $recursive;
        $this->urlApi = 'http://127.0.0.1:8001/api/v1/product/';
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
            $products = $response->data;
            return view('admin.product.index')->with([
                    'option' => $option,
                    'products' => $products,
            ]); //truyen products vao view index
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
        $file = $request->avatar;
        $file_path = $file->getPathname();
        $file_mime = $file->getMimeType('image');
        $file_uploaded_name = $file->getClientOriginalName();
        $originalName = Str::slug($request->avatar->getClientOriginalName());
        $hashName = $request->avatar->hashName();

        $client = new Client();
        $url = new Uri( $this->urlApi);
        // dd($url);
        $request1 = new RequestGuzzle('POST', $url);
        $formData = [
            [
                /** This is the actual fields name that you will use to access in API */
                'name'      => 'image',
                'filename' => $file_uploaded_name,
                'Mime-Type'=> $file_mime,
                /** This is the main line, we are reading from */
                'contents' => fopen($file_path, 'r'),
            ],
            [
                'name'     => 'name',
                'contents' => 'Example name'
            ]
        ];
        $options = [
            'multipart' => $formData,
            'header' => [
                'Content-Type' => 'multipart/form-data',
                'Accept' => 'application/json',
            ]
        ];
        // dd($request);
        try {

            // $response = $client->send($request1, $options);
            $response = $client->post($url, $options);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            dd($body);
            // $request = $client->post($this->urlApi, [
            //     'form_params' => [
            //         'name' => $request->name,
            //         'slug' => Str::slug($request->name),
            //         'category_id' => $request->category_id,
            //         'price' => $request->price,
            //         'description' => $request->description,
            //         'name_image' => $originalName,
            //         'hash_name' => $hashName,
            //     ]
            // ]);
            // $request = $client->post($this->urlApi, [
            //     /** Multipart form data is your actual file upload form */
            //     'multipart' => [
            //         [
            //             /** This is the actual fields name that you will use to access in API */
            //             'name'      => 'image',
            //             // 'filename' => $file_uploaded_name,
            //             // 'Mime-Type'=> $file_mime,
            //             /** This is the main line, we are reading from */
            //             'contents' => Psr7\Utils::tryFopen($file_path, 'r'),
            //         ],
            //         [
            //             'name'     => 'name',
            //             'contents' => 'Example name'
            //         ]
            //         /** Other form fields here, as we can't send form_fields with multipart same time */
            //         // [
            //         //     /** This is the form filed that we will use to acess in API */
            //         //     'name' => 'form-data',
            //         //     /** We need to use json_encode to send the encoded data */
            //         //     'contents' => json_encode(
            //         //         [
            //         //             'name' => $request->name,
            //         //             'slug' => Str::slug($request->name),
            //         //             'category_id' => $request->category_id,
            //         //             'price' => $request->price,
            //         //             'description' => $request->description,
            //         //         ]
            //         //         ),
                            
            //         // ],
            //     ]
            // ]);
        } catch (RequestException $e) {
            dd($e);

        }
        
        $response = json_decode($request->getBody()->getContents());
        dd($response);
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

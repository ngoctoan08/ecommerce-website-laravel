<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportExportProduct;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductSizeStore;
use App\Models\Size;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class ImportExportController extends Controller
{
    private $product;
    private $importExport;
    private $partner;
    private $size;
    private $store;
    private $productSizeStore;
    public function __construct(Product $productModel, ImportExportProduct $importExportModel, Partner $partnerModel, Size $sizeModel, StoreProduct $storeModel , ProductSizeStore $productSizeStoreModel)
    {
        $this->product = $productModel;
        $this->importExport = $importExportModel;
        $this->size = $sizeModel;
        $this->partner = $partnerModel;
        $this->store = $storeModel;
        $this->productSizeStore = $productSizeStoreModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->get();
        $sizes = $this->size->get();
        $partners = $this->partner->get();
        dd($products);   
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
        //
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
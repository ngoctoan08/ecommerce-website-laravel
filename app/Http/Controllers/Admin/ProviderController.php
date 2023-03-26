<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\TypePartner;
use App\Models\Area;

class ProviderController extends Controller
{
    private $provider;
    private $typePartner;
    private $area;
    public function __construct(Partner $providerModel, TypePartner $typePartnerModel, Area $areaModel)
    {
        $this->provider = $providerModel;
        $this->typePartner = $typePartnerModel;
        $this->area = $areaModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = $this->provider->latest()->paginate(5);
        $typePartners = $this->typePartner->get();
        $areas = $this->area->get();
        return view('admin.provider.index')->with([
            'areas' => $areas,
            'providers' => $providers,
            'typePartners' => $typePartners
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->provider->create([
            'area_id' => $request->area,
            'type_partner_id' => $request->type_partner,
            'name_partner' => $request->name,
            'address' => $request->address,
            'tel' => $request->tel,
            'email' => $request->email,
            'note' => $request->note,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Data has been saved'
        ]);
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
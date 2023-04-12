<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\ImportExportDetail;
use App\Models\ImportExportProduct;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $menu;
    private $importExport;
    private $importExportDetail;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Menu $menuModel, ImportExportProduct $importExportModel, ImportExportDetail $importExportDetailModel)
    {
        $this->menu = $menuModel;
        $this->importExport = $importExportModel;
        $this->importExportDetail = $importExportDetailModel;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showOrdered()
    {
        $userId = Auth::user()->id;
        $menus = $this->menu->showMenusHeader();
        $listOrdered = $this->importExport->showOrdered($userId);
        return view('web.pages.ordered', [
            'menus' => $menus,
            'listOrdered' => $listOrdered
        ]);
    }

    public function showDetailOrdered($id)
    {
        $menus = $this->menu->showMenusHeader();
        $listItem = $this->importExportDetail->showOrderedItemByOrderId($id);
        return view('web.pages.ordered-detail', [
            'menus' => $menus,
            'listItem' => $listItem
        ]);
    }

    public function getInfoUser()
    {
        $id = Auth::user()->id;
        dd($id);
    }
}
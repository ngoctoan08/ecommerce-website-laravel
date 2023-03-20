<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Components\Recursive;

class MenuController extends Controller
{
    private $menu; //model menu
    private $menuRecuise;
    //ham khoi tao co tham so truyen vao la menu
    public function __construct(Menu $menuModel, Recursive $recursive)
    {
        // $this->middleware('auth');  
        $this->menu = $menuModel;
        $this->menuRecuise = $recursive;
    }

    public function add() {
        $option = $this->menuRecuise->makeRecursive($this->menu, '');
        return view('admin.menu.add', compact('option'));
    }

    public function index() {
        // $menus = $this->menu->latest()->paginate(5);
        $menus = $this->menu->latest();
        $option = $this->menuRecuise->makeRecursive($this->menu, '');
        //cach 1
        // dd($menus);
        return view('admin.menu.index', compact('menus', 'option'));
    }


    // //noi nhan cac request gui len ex: post
    public function store(Request $request) {
        //insert vao datebase = phuong thuc create
        $this->menu->create([
            'name'=> $request->name, // du lieu nguoi dung gui len
            'parent_id' => $request->type,
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect(route('menu.index')); //tro ve ham index menu
    }

    public function edit($id) {
        $menu = $this->menu->find($id);
        $option = $this->menuRecuise->makeRecursive($this->menu, $menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'option'));
    }

    public function update($id, Request $request) {
        $menu = $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->type,
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect(route('menu.index')); //tro ve ham index menu
    }

    public function delete($id) {
        $this->menu->find($id)->delete();
        return redirect(route('menu.index'));
    }
}
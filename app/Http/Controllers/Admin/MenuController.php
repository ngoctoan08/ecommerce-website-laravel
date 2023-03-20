<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Components\Recursive;
use App\Http\Requests\MenuFormRequest;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu->latest()->get();
        $option = $this->menuRecuise->makeRecursive($this->menu, '');
        return view('admin.menu.index')->with([
            'option' => $option,
            'menus' => $menus,
    ]); //truyen categories vao view index;
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
    public function store(MenuFormRequest $request)
    {
        $data = $request->validated();
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-')
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
        $menu = $this->menu->find($id);
        $option = $this->menuRecuise->makeRecursive($this->menu, $menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'option'));
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
        // $menuRequest = $request->validated();
        $menu = $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công!'); //tro ve ham index menu
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
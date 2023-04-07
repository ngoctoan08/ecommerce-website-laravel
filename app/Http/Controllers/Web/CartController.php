<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{

    private $menu;
    private $category;
    private $product;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Menu $menuModel)
    {
        $this->menu = $menuModel;
    }
    
    /**
     * Show list item in cart
     *
     */
    public function index()
    {
        $menus = $this->menu->showMenusHeader();
        
        return view('web.pages.cart')->with([
            'menus' => $menus,
            
        ]);
    }
    /**
     * Handle add to cart of
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $data = $request->all();
        
        $idProduct = $data['product_id'];
        $sizeProduct = $data['product_size'];
        $qtyProduct = $data['product_qty'];
        
        $sessionId = substr(md5(microtime()), rand(0, 26), 5);
        
        $infoProduct = array(
            'session_id' => $sessionId,
            'product_id' => $idProduct,
            'product_name' => $data['product_name'],
            'product_retail_price' => $data['product_retail_price'],
            'product_path_image' => $data['product_path_image'],
            'product_qty' => $qtyProduct,
            'product_size' => $sizeProduct,
        );
        
        $cart = session()->get('cart');
        if(!$cart) {
            $cart[$idProduct][$sizeProduct] = $infoProduct;
            session(['cart' => $cart]);
        }
        // Da ton tai cart
        else {
            if(array_key_exists($idProduct, session('cart'))) {
                // Nếu trùng size thì tăng qty lên 1 đơn vị
                if(array_key_exists($sizeProduct, session('cart')[$idProduct])) {
                    $newQty = session('cart')[$idProduct][$sizeProduct]['product_qty'] + $qtyProduct;
                    session()->put('cart.'.$idProduct.'.'.$sizeProduct.'.product_qty', $newQty);
                }
                // Ngược lại thêm 1 nhánh con size mới
                else {
                    session()->put('cart.'.$idProduct.'.'.$sizeProduct, $infoProduct);
                }
            }
            else {
                session()->put('cart.'.$idProduct.'.'.$sizeProduct, $infoProduct);
            }
        }
        
        // Trả về html để update icon cart in header
        $htmlIconCart = $this->updateIconCart();
        
        return response()->json([
            'status' => 201,
            'message' => 'Thêm vào giỏ hàng thành công!',
            'htmlIconCart' => $htmlIconCart
        ]);
    }
    
    /**
     * Handle del item in cart of
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delItemInCart(Request $request)
    {
        
        
        $idProduct = $request->productId;
        $sizeProduct = $request->productSize;
        session()->start();
        if(session()->has('cart')) {
            if(session()->has('cart.'.$idProduct.'.'.$sizeProduct)) {
                session()->forget('cart.'.$idProduct.'.'.$sizeProduct);
            }
            if(empty(session('cart.'.$idProduct))) {
                session()->forget('cart.'.$idProduct);
            }
            if(empty(session('cart'))) {
                session()->forget('cart');
            }
        }
        // Trả về html để update icon cart in header
        $htmlIconCart = $this->updateIconCart();
        $htmlPageCart = $this->updatePageCart();
        return response()->json([
            'status' => 201,
            'message' => 'Xóa sản phẩm thành công!',
            'htmlIconCart' => $htmlIconCart,
            'htmlPageCart' => $htmlPageCart
        ]);
    }

    public function updateIconCart()
    {
        return view('web.partials.cart.icon_cart')->render();
    }

    public function updatePageCart()
    {
        return view('web.partials.cart.page_cart')->render();
    }
    
}
// Xử lý ajax thêm sản phẩm: Bằng id và size

$(document).ready(function () {});

// Hàm add to cart
function addToCart(url, data) {
    // Body API
    var options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            Accept: 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    };
    // Fetch API
    fetch(url, options)
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 201) {
                // toastr['success'](data.message);
                alertSuccess(data.message);
                $('.cart-order').html(data.htmlIconCart);
            } else {
                alert("lỗi");
                
            }
        });
}

// Hàm xóa sản phẩm trong giỏ hàng
function delItemInCart(url, data) {
    // Body API
    var options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            Accept: 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    };
    // Fetch API
    fetch(url, options)
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 201) {
                toastr['success'](data.message);
                $('.cart-order').html(data.htmlIconCart);
                $('.infor-product-pay').html(data.htmlPageCart);
            } else {
                alert("lỗi");
            }
        });
}

// Hàm cập nhật số lượng sản phẩm
function updateQtyInCart(url, data) {
    // Body API
    var options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            Accept: 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    };
    // Fetch API
    fetch(url, options)
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 201) {
                toastr['success'](data.message);
                $('.cart-order').html(data.htmlIconCart);
                $('.infor-product-pay').html(data.htmlPageCart);
            } else {
                alert("lỗi");
            }
        });
}

// Hàm xử lý xóa sản phẩm trong giỏ hàng
function handleDelItemInCart() {
    var productId = $(this).attr('id-product');
    var productSize = $(this).attr('size-product'); //38 -> 43
    var url = $(this).attr('url');
    var data = { productId, productSize };
    delItemInCart(url, data);
}


function handleUpdateQtyInCart() {
    var x = $(this).val(); //Lấy ra là cộng hoặc trừ
    var idProduct = $(this).attr('id-product');
    var sizeProduct = $(this).attr('size-product');
    var url = $(this).attr('url');
    var temp = $('.product_' + idProduct).val();
    if (x == '+') {
        temp++;
        $('.product_' + idProduct).val(temp);
        if ($('.product_' + idProduct).val() > 10 || $('.product_' + idProduct).val() <= 0) {
            $('.product_' + idProduct).val(1);
            toastr['info']('Số lượng sản phẩm không hợp lệ!');
        }
    }
    if (x == '-') {
        temp--;
        $('.product_' + idProduct).val(temp);
        if ($('.product_' + idProduct).val() > 10 || $('.product_' + idProduct).val() <= 0) {
            $('.product_' + idProduct).val(1);
            toastr['info']('Số lượng sản phẩm không hợp lệ!');
        }
    }
    var qtyProduct = $('.product_' + idProduct).val();
    if (qtyProduct > 0 && qtyProduct < 10) {
        var data = { idProduct, sizeProduct, qtyProduct};
        updateQtyInCart(url, data);
    }
}

function handleAddItemToCart() {
    // Lấy tất cả dữ liệu của sản phẩm đó lên
    // id, name, retail_price, name_image, path_image, qty
    var idProduct = $(this).val();
    var url = $(this).attr('url');
    // Dùng hàm validator để lấy data
    Validator({
        form: '#form_add_to_cart_' + idProduct,
        errorSelector: '.form-error',
        rules: [
        ],
        onSubmit: function(data) {
            // Call API
            console.log(data);
            addToCart(url, data); //gọi hàm
        }
    });
}

function handleSearchItem() {
    alert("Loading...");
}
// Xử lý ajax xóa sản phẩm: Bằng id và size
$(document).ready(function () {
    $(document).on('click', '.del_order', handleDelItemInCart);
    $(document).on('click', '.change_qty', handleUpdateQtyInCart);
    $(document).on('click', '.add_item_to_cart', handleAddItemToCart);
    $(document).on('keyup', '.search_product', handleSearchItem);
});

// Xử lý ajax tìm kiếm sản phẩm

$(document).ready(function () {
    // $(document).on('keyup', '.search_product', function () {
    //     var text = $('.search_product').val();
    //     $.ajax({
    //         type: 'POST',
    //         url: './Servers/AjaxProcess.php?action=search',
    //         data: {
    //             data: text,
    //         },
    //         dataType: 'html',
    //         success: function (response) {
    //             $(`.list-search-suggestions`).html(response);
    //         },
    //     });
    // });
});

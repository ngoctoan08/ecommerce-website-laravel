// Xử lý ajax thêm sản phẩm: Bằng id và size

$(document).ready(function () {
});

// Hàm add to cart

function addToCart(url, data) {
    // Body API
    var options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    }
    // Fetch API 
    fetch(url, options)
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        if(data.errors) {

        } else {
            toastr["success"](data.message);
        }
    })
}

// Hàm xóa sản phẩm trong giỏ hàng

function delItemInCart(url, data) {
    // Body API
    var options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    }
    // Fetch API 
    fetch(url, options)
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        if(data.errors) {

        } else {
            toastr["success"](data.message);
        }
    })
}

// Hàm cập nhật html ở trang cart

const renderOrderCart = () => {
    $.ajax({
        type: "GET",
        url: "./Servers/AjaxProcess.php?action=render",
        dataType: "html",

        success: function(response) {
            $('.infor-product-pay').html(response);
        }
    });
}

// Hàm cập nhật html ở icon cart
const updateCart = () => {
    $.ajax({
        type: "GET",
        url: "./Servers/AjaxProcess.php?action=update",
        dataType: "html",

        success: function(response) {
            $('.cart-order').html(response);
        }
    });
}

// Xử lý ajax xóa sản phẩm: Bằng id và size
$(document).ready(function () {
    $(document).on('click', '.del_order', function() {
        var productId = $(this).attr("id-product"); 
        var productSize = $(this).attr("size-product"); //38 -> 43
        var url = $(this).attr("url");
        var data = {productId, productSize};
        delItemInCart(url, data);
    });
});


// Xử lý ajax thanh toán ngay tại trang product detail
$(document).ready(function () {
    $('.border-choose-size').click(function() {
        if($(this).hasClass(`active`)) {
            $('.product-size').val($(this).attr("product-size"));
        }
    });
    
    $(document).on('click', '.pay_now', function() {
        var idProduct = $(this).val();
        var sizeProduct = $('.product-size').val()
        var qtyProduct = $('.input-qty').val()
        $.ajax({
            type: "POST",
            url: "./Servers/AjaxProcess.php?action=add",
            data: {
                id : idProduct,
                size: sizeProduct,
                qty : qtyProduct
            },
            dataType: "html",
            success: function (response) {
                if(response!=false) {
                    $(`.cart-order`).html(response);
                    toastr["success"](`<a href="gio-hang" style = "display: inline-block;" class="icon-cart h5">
                        Thêm vào giỏ hàng thành công! 
                            <span>
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                    </a>`)
                }
            }
        });
    });
});


// Xử lý ajax cập nhật số lượng sản phẩm ở trang giỏ hàng
$(document).ready(function () {
    $(document).on('click', '.change_qty', function() {
        var x = $(this).val(); //Lấy ra là cộng hoặc trừ
        var idProduct = $(this).attr("id-product")
        var sizeProduct = $(this).attr("size-product")
        var temp = $('.product_'+idProduct).val()
        if (x == '+') {
            temp ++;
            $('.product_'+idProduct).val(temp);
            if ($('.product_'+idProduct).val() > 10 || $('.product_'+idProduct).val() <= 0) {
                $('.product_'+idProduct).val(1)
                toastr["info"]("Số lượng sản phẩm không hợp lệ!")
            }
        }
        if (x == '-') {
            temp --;
            $('.product_'+idProduct).val(temp);
            if ($('.product_'+idProduct).val() > 10 || $('.product_'+idProduct).val() <= 0) {
                $('.product_'+idProduct).val(1)
                toastr["info"]("Số lượng sản phẩm không hợp lệ!")
            }
        }
        var qtyProduct = $('.product_'+idProduct).val()
        if (qtyProduct > 0 && qtyProduct < 10) {
            $.ajax({
                type: "POST",
                url: "./Servers/AjaxProcess.php?action=edit",
                data: {
                    id : idProduct,
                    size: sizeProduct,
                    qty : qtyProduct
                },
                dataType: "html",
                success: function (response) {
                    if (response) {
                        renderOrderCart();
                        updateCart();
                        toastr["success"]("Cập nhật giỏ hàng thành công!")
                    }
                }
            })
        }
    });
    
});


// Hiện thị thông tin chi tiết sản phẩm ở thanh pop up
$(document).ready(function () {
    $(document).on('click', '.view-infor', function() {
        var idProduct = $(this).attr("product-id");
        $.ajax({
            type: "POST",
            url: "./Servers/AjaxProcess.php?action=view",
            data: {
                id : idProduct
            },
            dataType: "json",
            success: function (response) {
                $(`.content-list-popup`).html(response);
            }
        });
    });
});


// Xử lý ajax tìm kiếm sản phẩm

$(document).ready(function () {
    $(document).on('keyup', '.search_product', function() {
        var text = $('.search_product').val();
        $.ajax({
            type: "POST",
            url: "./Servers/AjaxProcess.php?action=search",
            data: {
                data : text
            },
            dataType: "html",
            success: function (response) {
                $(`.list-search-suggestions`).html(response);
            }
        });
    });
});
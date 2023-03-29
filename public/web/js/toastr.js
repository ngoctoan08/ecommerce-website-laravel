// toa css
$(document).ready(function() { 
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    // $(`.add_to_cart`).click(function () {
    //     toastr["success"](`<div style = "display: inline-block;" class="icon-cart h5">
    //     Thêm vào giỏ hàng thành công! 
    //     <a href="index.php?page=cart">
    //         <span>
    //             <i class="fa-solid fa-bag-shopping"></i>
    //         </span>
    //     </a>
    // </div>`)
    // });

    // $(`.pay_now`).click(function () {
    //     toastr["success"]("Thêm vào giỏ hàng thành công!")
    // });

    // $(`.del_order`).click(function () {
    //     toastr["success"]("Xóa sản phẩm thành công!")
    // });

    // $(`.order-product`).submit(function () {
    //     toastr["success"]("Đặt hàng thành công!")
    // });
});
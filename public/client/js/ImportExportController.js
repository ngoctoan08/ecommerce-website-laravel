

// b1 bat su kien chon select option

// 2. Chon xong lay dc id cua san pham
// 3. Tu id do se truy van ra cac thong tin cua san pham do
// Onkeyup 2 o so luong va chiet khau -> update lại thông tin của tổng tiền

$(document).ready(function () {
    // Tính số size đã chọn
    

    // show ra sản phẩm chọn
    // $('#product').change(function (e) {
    //     idProduct = $(this).val();
    //     showProduct(idProduct);
    // });

    // Mỗi lần input sẽ update các ô input sau
    // 1, tổng tiền và thành tiền
    // function để xử lý điều này
    // đầu vào: các trường cần lấy value, eg: chiết khấu, số lượng
    // đầu ra: inner value vào 2 trường 

    // lời gọi hàm
    updateBill({
        inputSelectors: [
            '#quantity', 
        ],
        outputSelectors: [
            '#total_amount', '#bill_into_money'
        ],
        chooseProduct: '#product',
        sizeCheck: 'input[name="size[]"]',
        taxMoney:  'input[name="bill_tax_money"]'
    })

    
    
    // định nghĩa hàm
    function updateBill(options) {
        var totalAmount;
        var isCheckSize = false;
        var lengthSizeCheck;
        var entry_price;
        // chọn sản phẩm cần nhập
        $(options.chooseProduct).change(function (e) {
            var idProduct = $(this).val();
            showProduct(idProduct);
            
        });

        var qtySelector;
        // Nếu không chọn size thì không thay đổi được số lượng
        $(options.sizeCheck).change(function() {
            lengthSizeCheck = $('input[name="size[]"]:checked').length;
            isCheckSize = $('input[name="size[]"]:checked').length > 0 ? true : false;
            entry_price = $('#price').val();
            options.inputSelectors.forEach(function(inputSelector) {
                qtySelector = inputSelector;
                $(inputSelector).attr('disabled', !isCheckSize); //remove attr disabled
                // thực hiện onInput
                var disabled = $(inputSelector).attr('disabled');
                if(typeof disabled == 'undefined' && disabled == undefined) {
                    $(inputSelector).on('input', function() {
                        // Tính toán nhân quantity, giá, chiết khấu, thuế
                        totalAmount = $(this).val() * entry_price * lengthSizeCheck;
                        // update 2 cái cột kia
                        updateOuput(options, totalAmount);
                    })
                } 
                else {
                    innerHtml(inputSelector, 0);
                    // update all value to 0
                    updateOuput(options, 0);
                }
            })
            totalAmount = $(qtySelector).val() * entry_price * lengthSizeCheck;
            updateOuput(options, totalAmount);
        })
        var valueTax;
        $(options.taxMoney).change(function() {
            valueTax = $('input[name="bill_tax_money"]:checked').length > 0 ? $('input[name="bill_tax_money"]:checked').val() : false;
            if(valueTax) {
                totalAmount = $(qtySelector).val() * entry_price * lengthSizeCheck + ($(qtySelector).val() * entry_price * lengthSizeCheck * valueTax / 100)
                innerHtml('#bill_into_money', totalAmount);
            }
        })

        // Hàm update outPut với đầu vào là input và outPut
        function updateOuput(options, value) {
            options.outputSelectors.forEach(function(outputSelector) {
                $(outputSelector).val(value);
            })
        }
        
    }

});


// function create product
function showProduct(id) {
    const url = 'http://127.0.0.1:8000/admin/product/'+id;
    // Body API
    var options = {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            'Accept': 'application/json',
          }
    }
    // Fetch API 
    fetch(url, options)
    .then((response) => response.json())
    .then((data) => {
        if(data.status === 200) {
            var product = data.result;
            innerHtml("#unit", product.conversion_unit);
            innerHtml("#price", product.entry_price);
            console.log(product);
        }
    })
}

function innerHtml(nameElement, data) {
    $(nameElement).val(data);
}
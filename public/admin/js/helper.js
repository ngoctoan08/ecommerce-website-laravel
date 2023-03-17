//This file is functions, which can use by another file

function convertToSlug(str) {
    str = str.toLowerCase();
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    str = str.replace(/([^0-9a-z-\s])/g, '');
    str = str.replace(/(\s+)/g, '-');
    str = str.replace(/-+/g, '-');
    str = str.replace(/^-+/g, '');
    str = str.replace(/-+$/g, '');
    return str;
}

function alertSuccess(text) {
    Swal.fire({
        position: 'top-middle',
        icon: 'success',
        title: text,
        showConfirmButton: false,
        timer: 3000,
    });
}

function alertError(text) {
    Swal.fire({
        icon: 'error',
        title: text,
        showConfirmButton: false,
        timer: 3000,
    });
}

// This function show alert when the form invalid

function appendColumnError(nameCol, text) {
    $('.col-' + nameCol).append(alertErrorLabel(text));
    $('#' + nameCol).addClass('is-invalid');
}

// Append data when insert success
function appendDataOption(parentSelector, data) {
    $(parentSelector).append('<option value = "' + data  + '"> ' + data + ' </option>');
}

// This function remove error when click btn save again
function removeError() {
    $('.form-error').empty();
    $('.form-control').removeClass('is-invalid');
}

function alertErrorLabel(text) {
    return (
        '<div class="form-error"> <span> <i class="fa fa-exclamation-circle"></i></span><span class="error_message">' +
        text +
        '</span></div>'
    );
}

function hideModal(idModal) {
    $(idModal).modal('hide');
}

function handleSuccess(text) {
    alertSuccess(text);
    hideModal();
    $('#form_item').find('input[type=text], textarea').val('');
}

function ajaxRequest(type, url, data) {
    $.ajax({
        type: type,
        url: url,
        data: data,
        dataType: 'json',
        success: function (response) {
            if (type == 'get') {
                var dataResponse = response.data;
                $('#id').val(dataResponse.id);
                $('#name').val(dataResponse.name);
                $('#description').val(dataResponse.description);
                var parent_id = dataResponse.parent_id;
                var select = document.getElementById('parent_id');
                var length = document.getElementById('parent_id').options.length;
                for (var i = 0; i < length; i++) {
                    if (select.options[i].value == parent_id) {
                        select.options[i].selected = true;
                    }
                }
            }
            if (type == 'post' || type == 'put') {
                alertSuccess(response.message);

                // location.reload();
            }
        },
        error: function (error) {
            if (type == 'post' || type == 'put') {
                alertError(error.responseJSON.message);
                errors = error.responseJSON.errors;
                if (errors.name) {
                    appendColumnError('name', errors.name);
                }
                if (errors.description) {
                    appendColumnError('description', errors.description);
                }
                console.log(error.responseJSON.errors);
            }
        },
    });
}

var checkAll = $('#check_all');
var itemsCheck = $('input[name="item[]"]');
var btnSubmitForm = $('.btn-submit-form');
var formContainer = $('.form_container');

checkAll.change(function () {
    var isCheckedAll = $(this).prop('checked'); //return true or false
    itemsCheck.prop('checked', isCheckedAll);
    enableSubmitBtn();
});

itemsCheck.change(function () {
    var isCheckedAll = itemsCheck.length === $('input[name="item[]"]:checked').length ? true : false; //return true or false
    //if lengthItem = lengthItemChecked --> checkAll have to checked
    checkAll.prop('checked', isCheckedAll);
    enableSubmitBtn();
});

//enable submit btn || remove class disabled
function enableSubmitBtn() {
    var checkedCount = $('input[name="item[]"]:checked').length;
    if (checkedCount > 0) {
        //enable btn submit
        btnSubmitForm.removeClass('disabled');
    } else {
        btnSubmitForm.addClass('disabled');
    }
}

formContainer.on('submit', function (e) {
    // e.preventDefault();
});

btnSubmitForm.on('click', function (e) {
    e.preventDefault();
    var isSubmitable = !$(btnSubmitForm).hasClass('disabled');
    if (isSubmitable) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!',
        }).then((result) => {
            if (result.isConfirmed) {
                formContainer.submit();
            }
        });
    }
});




function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "$" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "$" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}
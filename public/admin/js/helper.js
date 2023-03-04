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
      timer: 3000
      })
  }

function alertError(text) {
  Swal.fire({
    icon: 'error',
    title: text,
    showConfirmButton: false,
    timer: 3000
  })
}

// This function show alert when the form invalid

function appendColumnError(nameCol, text)
{
  $('.col-'+nameCol).append(alertErrorLabel(text));
  $('#'+nameCol).addClass('is-invalid');
}

// This function remove error when click btn save again
function removeError()
{
  $('.form-error').empty();
  $('.form-control').removeClass('is-invalid');
}

function alertErrorLabel(text) 
{
  return '<div class="form-error"> <span> <i class="fa fa-exclamation-circle"></i></span><span class="error_message">' + text + '</span></div>'
}

function hideModal() {
  $('#staticModal').modal('hide')
}

function handleSuccess(text) {
  alertSuccess(text);
  hideModal();
  $("#form_item").find("input[type=text], textarea").val("");
}

function ajaxRequest(type, url, data)
{
  $.ajax({
    type: type,
    url: url,
    data: data,
    dataType: "json",
    success: function (response) {
      if(type == "get") {
        var dataResponse = response.data;
        $('#id').val(dataResponse.id);
        $('#name').val(dataResponse.name);
        $('#description').val(dataResponse.description);
        var parent_id = dataResponse.parent_id;
        var select = document.getElementById("parent_id");
        var length = document.getElementById("parent_id").options.length;
        for(var i = 0; i < length ;i++) {
          if(select.options[i].value == parent_id) {
            select.options[i].selected = true;
          }
        }
      }
      if(type == "post" || type == "put") {
        alertSuccess(response.message);

        // location.reload();
      }
      
    },
    error: function(error) {
      if(type == "post" || type == "put") {
        alertError(error.responseJSON.message);
        errors = error.responseJSON.errors;
        if(errors.name) {
          appendColumnError('name', errors.name);
        }
        if(errors.description) {
          appendColumnError('description', errors.description);
        }
        console.log(error.responseJSON.errors);
      }
      
    }
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
    var isCheckedAll =
        itemsCheck.length === $('input[name="item[]"]:checked').length
            ? true
            : false; //return true or false
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

formContainer.on('submit', function(e){
  // e.preventDefault();
});

btnSubmitForm.on('click', function(e){
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
      confirmButtonText: 'Yes, do it!'
    }).then((result) => {
      if (result.isConfirmed) {
        formContainer.submit();
      }
    })
  }
});


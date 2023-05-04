
const categoryApi = BASE_URL + VERSION + 'category/';

// function create Category
function createCaterory(data) {
    // Body API
    var options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            // 'accept': '*',
            'Accept': 'application/json',
          },
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    }
    // Fetch API 
    fetch(categoryApi, options)
    .then((response) => response.json())
    .then((data) => {
        if(data.errors) {
            alertError(data.message);
            var dataErrors = data.errors;
            for (const key in dataErrors) {
                if(dataErrors.hasOwnProperty(key)) {
                    var value = dataErrors[key];
                    //do something with value;
                    appendColumnError(key, value);
                }
            }
        } else {
            // handleSuccess(data.message);
            console.log(data.message);
            alertSuccess(data.message);
            location.reload();     
        }
    })
}

// function delete Category
function deleteCategory(id, url_fDelete = '') {
    // Body API
    var options = {
        method: "DELETE",
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            // 'Content-Type': 'application/x-www-form-urlencoded',
          },
    }
    // Fetch API 
    fetch(categoryApi + url_fDelete + id, options)
    .then((response) => response.json())
    .then((data) => {
        if(data.status === 200) {
            alertSuccess(data.message);
            $('#item_'+id).remove();
        }
        else {
            alertError(data.message);
        }
    })
}

// function restore Category
function restoreCategory(id) {
    // Body API
    var options = {
        method: "GET",
    }
    // Fetch API 
    fetch(categoryApi + 'restore/' + id, options)
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        if(data.status === 200) {
            alertSuccess(data.message);
            $('#item_'+id).remove();
        }
        else {
            alertError(data.message);
        }
    })
}

function handleDelete(event) {
    event.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).attr('data-id');
            var url_fDelete = $(this).attr('paramFDelete'); // url: request to force delete url
            deleteCategory(id, url_fDelete);
        }
      })
}

function handleRestore(event) {
    event.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, restore it!'
    }).then((result) => {
      if (result.isConfirmed) {
          var id = $(this).attr('data-id');
          restoreCategory(id);
      }
    })
}

$(document).ready(function(event) {
    // $('.btn-save-item').on('click', handleCreate);
    $('.btn-del-item').on('click', handleDelete); //
    $('.btn-restore-item').on('click', handleRestore);
    // test process category
})



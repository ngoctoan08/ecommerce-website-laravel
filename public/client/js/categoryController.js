
const categoryApi = BASE_URL + VERSION + 'category/';
// start();    

function start() {
    getCategories(renderCategories)
}

function getCategories(callback) {
    fetch(categoryApi)
    .then(function(response) {
        return response.json()
    })
    .then(callback);    
}

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
            alertSuccess(data.message);
            console.log(data);
            // location.reload();     
        }
    })
}

// function create product
function createProduct(data) {
    // var options = {
    //     method: "POST",
    //     body: data // body data type must match "Content-Type" header
    // };
    // fetch(categoryApi, options)
    // .catch(console.error);
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
        // headers: {
        //     'Content-Type': 'application/json',
        //     'Accept': 'application/json',
        //     // 'Content-Type': 'application/x-www-form-urlencoded',
        //   },
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

function renderCategories(categories) {
    var listCategories = $('#list_categories');
    var htmls = categories.data.map(function(category) {
        return `<tr class="tr-shadow" id="item_${category.id}">
        <td class="desc">
            <a href="">
                ${category.id}
            </a>
        </td>                                    
        <td><input type="checkbox" name="choose" id="choose"></td>
        <td>${category.name}</td>
        <td>${category.parent_id}</td>
        <td>${category.slug}</td>
        <td>
            <div class="table-data-feature justify-content-center">
                <button data-id = "${category.id}" type="button" class="item btn-show-item" data-toggle="modal" data-target="#staticModal" title="Edit">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button data-id = "${category.id}" type="button" onclick = "handleDelete(${category.id})" class="item btn-del-item" title="Delete">
                    <i class="zmdi zmdi-delete"></i>
                </button>
            </div>
        </td>
    </tr>
        `;
    });
    listCategories.append(htmls);
}

function handleCreate(event) {
    event.preventDefault();
    removeError();
    var parent_id = $('#parent_id').val();
    var name = $('#name').val();
    var description = $('#description').val();
    var slug = convertToSlug(name);
    var formData = {parent_id, name, slug, description,};
    console.log(formData);
    createCaterory(formData);
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
    $('.test').on('click', function() {
        var formdata = new FormData();
        formdata.append("name", "John Doe");
        formdata.append("phone", "1234567890");
        var x = document.getElementById("avatar").files[0];
        console.log(x);
        formdata.append("image", document.getElementById("avatar").files[0]);
        console.log(formdata.get("name"));
        var options = {
            method: "POST",
            body: formdata,
            // mode: 'no-cors'
        }

        fetch('http://localhost:8001/api/v1/product/', options)
        .then((response) => response.json())
        .then((data) => console.log(data))
        .catch((error) => 
            console.log(error)
        );
    })
})



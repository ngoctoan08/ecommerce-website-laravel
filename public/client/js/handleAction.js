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
            deleteItem(id, url_fDelete);
        }
      })
}

function deleteItem(id, url_fDelete = '') {
    const url = window.location.href + '/';
    console.log(url);
    //Body API
    var options = {
        method: "DELETE",
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //Fix csrf not miss match
          },
    }
    // Fetch API 
    fetch(url + url_fDelete + id, options)
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





$(document).ready(function(event) {
    $('.btn-del-item').on('click', handleDelete); //
    // $('.btn-restore-item').on('click', handleRestore);
    // test process category
})

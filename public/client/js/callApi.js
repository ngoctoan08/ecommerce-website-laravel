// Load data from Api

// [GET] Index
function index(param) {
    $.get(BASE_URL + VERSION + param, function(res) {
        if(res.status == 200) {
            result = res.data;
            // console.log(result);
            var table = $('#list_'+param);
            for(i=0; i < result.length; i++) {
                $('#list_' + param).append(`<tr class="tr-shadow" id="item_${result[i].id}">
                <td class="desc">
                    <a href="">
                    ${i+1}</td>
                    </a>
                <td>${result[i].name}</td>
                <td>${result[i].parent_id}</td>
                <td>${result[i].slug}</td>
                <td>
                    <div class="table-data-feature justify-content-center">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                            <a href="{{route('${param}.edit', ${result[i].id} )}}">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                        </button>
                          <button data-id = "${result[i].id}" url="{{route('${param}.destroy', ${result[i].id} )}}" class="item btn-del-item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <i class="zmdi zmdi-delete"></i>
                          </button>
                    </div>
                </td>
            </tr>`)
            }
        }
      })
}

    // [POST]
function actionSave() {
    //List property submit to API
    var parent_id = $('#parent_id').val();
    var name = $('#name').val();
    var description = $('#description').val();
    var categoryRequest = {
        parent_id,
        name, 
        description,
    }
    event.preventDefault();
    alert(12);
    // console.log(categoryRequest);
    //   $.ajax({
    //     type: "POST",
    //     url: BASE_URL + VERSION + param,
    //     data: categoryRequest,
    //     success: function (res) {
    //         if(res.status == 201) {
    //         Swal.fire({
    //             position: 'top-midde',
    //             icon: 'success',
    //             title: 'Your work has been saved',
    //             showConfirmButton: false,
    //             timer: 1500
    //           })
    //     }
    //     }
    //   });
  }

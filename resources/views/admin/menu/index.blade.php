@extends('admin.index')
@section('title')
    <title>Menu</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
        @include('admin.partials.action')
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    @if(!empty($menus))
                    <form action="{{route('category.handle-action')}}" method="POST" class="form_container">
                        @csrf
                        @include('admin.partials.function')
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center list-menu justify-content-center">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="check_all">
                                    </th>
                                    <th>ID</th>
                                    <th>Tên menu</th>
                                    <th>Slug</th>
                                    <th>Parent ID</th>
                                    <th>Page</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="list_menu">
                                @foreach($menus as $menu)
                                <tr class="tr-shadow">
                                    <td><input type="checkbox" name="item[]" value="{{$menu->id}}"></td>

                                    <td class="desc">
                                        <a href="">
                                        {{$menu->id}}</td>
                                        </a>
                                        
                                    <td>{{$menu->name}}</td>
                                    <td>{{$menu->slug}}</td>
                                    <td>{{$menu->parent_id}}</td>
                                    <td>{{$menu->page_id == 0 ? 'Admin' : 'Web'}}</td>
                                    <td>
                                        <div class="table-data-feature justify-content-center">
                                            <div class="table-data-feature justify-content-center">
                                                <a class="item" title="Edit" href="{{route('menu.edit', $menu->id )}}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a data-id = "{{$menu->id}}"  class="item btn btn-del-item" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                    {{-- {{$menus->links()}} --}}
                    
                    </form>
                    @endif 
                    @empty($menus)
                        No record! 
                        {{-- <button  type="button" class="btn-create-item" data-toggle="modal" data-target="#staticModal"> Create one?</button> --}}
                        <a class="item btn" href="{{route('category.trash')}}"> Go to Trash list</a>
                    @endempty
                </div>
            </div>

          

            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
          </div>
      </div>
  </div>
</div>
<!-- modal static -->
<div class="modal fade modal-show" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
data-backdrop="static" >
   <div  class="modal-dialog modal-sm" role="document">
       <div class="modal-content">
        <div class="modal-header">
            <h4>Thêm mới Menu</h4>
        </div>
        <div class="modal-body">
            <div class="custom-tab">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home"
                            aria-selected="true">General information</a>
                    </div>
                </nav>
                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                        <div class="card m-t-30" style="border: none !important">
                            <div class="card-body card-block">
                                <form action="{{route('menu.store')}}" method="POST" class="form-horizontal" id="form-create-menu" name="form-create-menu">
                                    @csrf
                                    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="parent_id" class=" form-control-label">Belonging to the group:</label>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <select required name="parent_id" id="parent_id" class="form-control">
                                                <option value="0"> Original</option>
                                                {!!$option!!}
                                            </select>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="name" class=" form-control-label"> Name:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-name">
                                            <input type="text" id="name" name="name" placeholder="Name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="page" class=" form-control-label">Page:</label>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <select required name="page_id" id="page" class="form-control">
                                                <option value="0"> Admin</option>
                                                <option value="1"> Web</option>
                                            </select>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth
                            master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh
                            dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone.
                            Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
                    </div>
                    <div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth
                            master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh
                            dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone.
                            Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
                    </div>
                </div>

            </div>
        </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary btn-save-item">Save</button>
           </div>
        </form>
       </div>
   </div>
</div>
<!-- end modal static -->
@endsection

@section('js')
    <!-- Config URL API-->
    <script src="{{asset('admin/js/config.js')}}"></script>
    <!-- Alert CDN -->
    <script src="{{asset('admin_template/js/sweetalert.js')}}"></script>
    <!-- Helper Function -->
    <script src="{{asset('admin/js/helper.js')}}"></script>
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    <script>
        Validator({
            form: '#form-create-menu',
            errorSelector: '.form-error',
            rules: [
                Validator.isRequired('#name'),
                Validator.isRequired('#parent_id'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
                createMenu(data)
            }
        });


        // Create
    function createMenu(data) {
        const menuUrl = 'http://127.0.0.1:8000/admin/menu/';
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
        fetch(menuUrl, options)
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
                alertSuccess(data.message);
                hideModal('#staticModal');
                // append data
                window.location.reload();
            }
        })
    }
    </script>
    
    @if(Session::has('success'))
    <script>
        alertSuccess('{{Session::get('success')}}')
    </script>
    @endif
    @if(Session::has('error'))
    <script>
        alertError('{{Session::get('error')}}')
    </script>
    @endif
@endsection
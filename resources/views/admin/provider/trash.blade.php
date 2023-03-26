@extends('admin.index')
@section('title')
    <title>Category</title>
@endsection

@section('content')
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
        @include('admin.partials.action')
          <div class="row m-t-30">
              <div class="col-md-12">
                @if(!empty($categories))
                <form action="{{route('category.handle-action')}}" method="POST" class="form_container">
                    @csrf
                  @include('admin.partials.function')
                  <!-- DATA TABLE-->
                  <div class="table-responsive table-responsive-data2">
                      <table class="table table-data2 text-center list-category justify-content-center">
                          <thead>
                              <tr>
                                  <th>
                                    <input type="checkbox" id="check_all">
                                    </th>
                                  <th>No</th>

                                  <th>Name</th>
                                  <th>Group</th>
                                  <th>Slug</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody id="list_categories">
                                
                                @foreach($categories as $category)
                                <tr class="tr-shadow" id="item_{{$category->id}}">
                                    <td><input type="checkbox" name="item[]" value="{{$category->id}}"></td>

                                    <td class="desc">
                                        <a href="">
                                            {{$category->id}}
                                        </a>
                                    </td>

                                    <td>{{$category->name}}</td>
                                    <td>{{$category->parent_id}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>
                                        <div class="table-data-feature justify-content-center">
                                            <a data-id = "{{$category->id}}" class="item btn btn-restore-item" title="Restore">
                                                <i class="fa fa-undo"></i>
                                            </a>
                                            <a data-id = "{{$category->id}}" paramFDelete = "fDelete/" class="item btn btn-del-item" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            
                          </tbody>
                      </table>
                  </div>
                  <!-- END DATA TABLE-->
                </form>
                @endif 
                @empty($categories)
                    No record! 
                    {{-- <button  type="button" class="btn-create-item" data-toggle="modal" data-target="#staticModal"> Create one?</button> --}}
                    <a class="item btn" href="{{route('category.index')}}"> Go to List</a>
                @endempty
                  <!-- PAGINATE-->
                  {{-- {!!$categories->links()!!} --}}
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
{{-- @include('admin.partials.modal') --}}

@endsection

@section('js')
    <!-- Config URL API-->
    <script src="{{asset('admin/js/config.js')}}"></script>
    <!-- Call API from URL API-->
    {{-- <script src="{{asset('client/js/callApi.js')}}"></script> --}}
    <!-- Alert CDN -->
    <script src="{{asset('admin_template/js/sweetalert.js')}}"></script>
    <!-- Helper Function -->
    <script src="{{asset('admin/js/helper.js')}}"></script>
    <!-- Handle Category page -->
    <script src="{{asset('client/js/categoryController.js')}}"></script>

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
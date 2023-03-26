@extends('admin.index')
@section('title')
    <title>Edit</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{route('category.index')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-list-ul"></i>List</button></a>
            <div class="card m-t-30">
                <div class="card-body card-block">
                    <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal" name="frm_edit_category">
                        @csrf
                        @method('PUT')
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
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-5">
                                <label for="name" class=" form-control-label"> Name:</label>
                            </div>
                            <div class="col-12 col-md-7 col-name">
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control" value="{{$category->name ? $category->name : ''}}">
                            </div>
                            
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-5">
                                <label for="description" class=" form-control-label"> Description:</label>
                            </div>
                            <div class="col-12 col-md-7 col-description">
                                <textarea type="text" id="description" name="description" placeholder="Description" class="form-control" value="" rows="6">{{$category->description ? $category->description : ''}} </textarea>
                            </div>
                        </div>
            
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" name="edit_category">
                                <i class="fa fa-dot-circle-o"></i> Save
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

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
@endsection
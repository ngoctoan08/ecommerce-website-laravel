@extends('admin.index')
@section('title')
    <title>Edit</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{route('menu.index')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-list-ul"></i>List</button></a>
            <div class="card m-t-30">
                <div class="card-body card-block">
                    <form action="{{route('menu.update', $menu->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal" name="frm_edit_menu">
                        @csrf
                        @method('PUT')
                        <div class="row form-group">
                            <div class="col col-md-5">
                                <label for="parent_id" class=" form-control-label">Danh mục cha:</label>
                            </div>
                            <div class="col-12 col-md-7">
                                <select required name="parent_id" id="parent_id" class="form-control">
                                    <option value="0"> Gốc </option>
                                    {!!$option!!}
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-5">
                                <label for="name" class=" form-control-label"> Tên danh mục:</label>
                            </div>
                            <div class="col-12 col-md-7 col-name">
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control" value="{{$menu->name ? $menu->name : ''}}">
                            </div>
                        </div>
                        <input type="hidden" name="page_id" value="{{$menu->page_id}}">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" name="edit_menu">
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

    @if(Session::has('success'))
    <script>
        alertSuccess('{{Session::get('success')}}')
    </script>
    @endif
@endsection
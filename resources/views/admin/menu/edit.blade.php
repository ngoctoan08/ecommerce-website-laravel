@extends('layouts.admin')
@section('title')
    <title>Edit Menu</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- <?php
            include_once './views/notification/alert.php';  
            ?> --}}
            <a href="{{route('menu.index')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-list-ul"></i>Danh sách Menu</button></a>
            <div class="card m-t-30">
                <div class="card-body card-block">
                    <form action="{{route('menu.update', ['id' => $menu->id])}}" method="POST" enctype="multipart/form-data" class="form-horizontal" name="frm_edit_menu">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="name" class=" form-control-label"> Tên Menu</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="name" name="name" placeholder=" Nhập tên Menu" class="form-control" value="{{$menu->name}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Danh mục</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="type" id="select" class="form-control">
                                   {!!$option!!}
                                </select>
                            </div>
                        </div>
            
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" name="add_menu">
                                <i class="fa fa-dot-circle-o"></i> Lưu
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Hoàn tác
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
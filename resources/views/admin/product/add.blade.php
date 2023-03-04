@extends('admin.index')
@section('title')
    <title>Add Product</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{route('product.index')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-list-ul"></i>Danh sách sản phẩm</button></a>
            <div class="card m-t-30">
                <div class="card-body card-block">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" name="frm_add_product">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="name" class=" form-control-label"> Tên sản phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input  type="text" id="name" name="name" placeholder=" Nhập tên sản phẩm" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Danh mục</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select  name="category_id" id="select" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Tình trạng</label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check-inline form-check">
                                    <div class="radio">
                                        <label for="hide" class="form-check-label ">
                                            <input checked type="radio" id="hide" name="status" value="1" class="form-check-input">Hiện thị
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="unhide" class="form-check-label ">
                                            <input type="radio" id="unhide" name="status" value="0" class="form-check-input">Ẩn
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="price" class=" form-control-label">Giá</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min='0' step="0.5" id="price" name="price" placeholder="Nhập giá" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="textarea-input" class=" form-control-label">Chi tiết sản phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea id="my-editor" name="description" class="form-control" placeholder="Nhập chi tiết sản phẩm...">{!! old('content', 'Nhập chi tiết sản phẩm...') !!}</textarea>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="avatar" class=" form-control-label">Ảnh đại diện</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="avatar" name="avatar" class="form-control-file" accept="image/png, image/jpeg, image/jpg" class="up_avatar">
                                <img class="m-t-10 up_ava__success" style="width: 100px;" src="" alt="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="sub_avatar" class=" form-control-label">Ảnh phụ</label>
                            </div>
                            <div class="col-12 col-md-9 view_sub__avatar">
                                <input type="file" id="sub_avatar" name="sub_avatar[]" multiple="" class="form-control-file" accept="image/png, image/jpeg, image/jpg">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" name="add_product">
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

@section('js')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        // filebrowserUploadMethod: 'form'
    };
    </script>
    <script>
    CKEDITOR.replace('my-editor', options);
    </script>
@endsection
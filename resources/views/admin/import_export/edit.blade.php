@extends('admin.index')
@section('title')
    <title>Edit Product</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{route('product.index')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-list-ul"></i>Danh sách danh mục</button></a>
            <div class="card m-t-30">
                <div class="card-body card-block">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-edit-product" name="form-edit-product">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        {{-- Mã code --}}
                        <div class="row form-group">
                            <div class="col col-md-5">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="code_id" class=" form-control-label"> Mã code</label>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <input  type="text" id="code_id" name="code_id" placeholder="Mã code (để trống sẽ tự sinh)" class="form-control" value="{{$product->code_id}}">
                                    </div>
                                </div>
                            </div>  
                        </div>
                        {{-- Tên sản phẩm --}}
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-5">
                                        <label for="name" class=" form-control-label"> Tên sản phẩm</label>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <input  type="text" id="name" name="name" placeholder=" Nhập tên sản phẩm" class="form-control" value="{{$product->name}}">
                                    </div>
                                </div>
                            </div> 
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="category" class=" form-control-label">Nhóm hàng</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select  name="category_id" id="category" class="form-control">
                                            <option value="0"> Nhóm hàng gốc</option>
                                            {!!$option!!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="standard_stock" class=" form-control-label"> Tồn định mức</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input  type="number" id="standard_stock" name="standard_stock" placeholder="Nhập tồn đinh mức" class="form-control" value="{{$product->standard_stock}}">
                                    </div>
                                </div>
                            </div>  
                        </div>
                        {{-- Các loại giá --}}
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="entry_price" class=" form-control-label">Giá nhập</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="number" min='0' step="0.5" id="entry_price" name="entry_price" placeholder="Nhập giá nhập" class="form-control input-currency" value="{{$product->entry_price}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="wholesale_price" class=" form-control-label">Giá bán buôn</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="number" min='0' step="0.5" id="wholesale_price" name="wholesale_price" placeholder="Nhập giá bán buôn" class="form-control input-currency" value="{{$product->wholesale_price}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="retail_price" class=" form-control-label">Giá bán lẻ</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="number" min='0' step="0.5" id="retail_price" name="retail_price" placeholder="Nhập giá bán lẻ" class="form-control input-currency" value="{{$product->retail_price}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Đơn vị quy đổi và mô tả sản phảm --}}
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="list_conversion_unit" class=" form-control-label">Đơn vị quy đổi</label>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex">
                                        <select  name="conversion_unit" id="list_conversion_unit" class="form-control">
                                            @foreach($units as $unit)
                                                <option value="{{$unit->conversion_unit}}">
                                                    {{$unit->conversion_unit}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="col col-md-2">
                                            <button style="height: 38px;" type="button" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#modalUnit">
                                                <i class="fa fa-plus-square"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col col-md-8">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Chi tiết sản phẩm</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="description" name="description" class="form-control" placeholder="Nhập chi tiết sản phẩm...">{{$product->description}}</textarea>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                        {{-- Avatar --}}
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="avatar" class=" form-control-label">Ảnh đại diện</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="avatar" name="avatar" class="form-control-file" accept="image/png, image/jpeg, image/jpg" class="up_avatar">
                                <div id="avatar_{{$product->id}}" class="box-extra-photo-edit">
                                    <img class="m-t-10" style="width: 100px;" src="{{asset($product->path_image)}}" alt="">
                                    <span class="avatar_remove" avatar-id="83">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                                <img class="m-t-10 up_ava__success" style="width: 100px;" src="" alt="">
                            </div>
                        </div>
                        {{-- Sub images --}}
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="sub_avatar" class=" form-control-label">Ảnh phụ</label>
                            </div>
                            <div class="col-12 col-md-9 view_sub__avatar">
                                <input type="file" id="sub_avatar" name="sub_avatar[]" multiple="" class="form-control-file" accept="image/png, image/jpeg, image/jpg">
                                @foreach($subImages as $subImage)
                                    <div id="avatar_{{$subImage->id}}" class="box-extra-photo-edit">
                                        <img class="m-t-10" style="width: 100px;" src="{{asset($subImage->path_sub_image)}}" alt="">
                                        <span class="sub_avatar_remove" sub_avatar-id="83">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
    <!-- Alert CDN -->
    <script src="{{asset('admin_template/js/sweetalert.js')}}"></script>
    <!-- Helper Function -->
    <script src="{{asset('admin/js/helper.js')}}"></script>
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    {{-- Handle Product page --}}
    <script src="{{asset('client/js/productController.js')}}"></script>
    {{-- Handle Action --}}
    <script src="{{asset('client/js/handleAction.js')}}"></script>
    <!-- Handle Validate Form -->
    
    <script>
        // Format currency

        // Validator
        Validator({
            form: '#form-edit-unit',
            errorSelector: '.form-error',
            rules: [
                Validator.isRequired('#conversion_unit'),
                // Validator.isRequired('#price'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
                createUnit(data);
            }
        });
    </script>
    {{-- Handle ckeditor --}}
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
    CKEDITOR.replace('description', options);
    </script>


    {{-- Handle alert response from server to client --}}
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
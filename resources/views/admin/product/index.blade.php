@extends('admin.index')
@section('title')
    <title>Product</title>
@endsection

@section('content')
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
        @include('admin.partials.action')
          <div class="row m-t-30">
              <div class="col-md-12">
                @if(!empty($products))
                <form action="{{route('category.handle-action')}}" method="POST" class="form_container">
                    @csrf
                    @include('admin.partials.function')
                    <!-- DATA TABLE-->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center list-product justify-content-center">
                            <thead>
                                <tr >
                                    <th>No</th>
                                    <th>
                                        <input type="checkbox" id="check_all">
                                    </th>
                                    <th>Ảnh đại diện</th>
                                    <th>Tên</th>
                                    <th>Danh mục</th>
                                    <th>Trạng thái</th>
                                    <th>Giá nhập</th>
                                    <th>Giá bán buôn</th>
                                    <th>Giá bán lẻ</th>
                                    <th>Tồn</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="list_product">
                                
                                @foreach($products as $product)
                                <tr class="tr-shadow" id="{{$product->id}}">
                                    {{-- <td style="line-height: 145px;">{{ $loop->index + 1 }}</td> --}}
                                    <td style="line-height: 145px;">{{ $product->id}}</td>
                                    <td><input type="checkbox" name="item[]" value="{{$product->id}}"></td>
                                    <td>
                                        <a href="">
                                            <img style="width: 150px;" src="{{asset($product->path_image)}}" alt="">
                                        </a>
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category_id}}</td>
                                    <td>{{$product->status}}</td>
                                    <td>{{$product->entry_price}}</td>
                                    <td>{{$product->wholesale_price}}</td>
                                    <td>{{$product->retail_price}}</td>
                                    <td>{{$product->standard_stock}}</td>
                                    <td>
                                        <div class="table-data-feature justify-content-center">
                                            <a class="item" title="Edit" href="{{route('product.edit', $product->id )}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a data-id = "{{$product->id}}" class="item btn btn-del-item" href = "{{route('product.destroy', $product->id )}}" title="Delete">
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
                @empty($products)
                    No record! 
                    {{-- <button  type="button" class="btn-create-item" data-toggle="modal" data-target="#staticModal"> Create one?</button> --}}
                    <a class="item btn" href="{{route('category.trash')}}"> Go to Trash list</a>
                @endempty
                  {{-- {{$products->links()}} --}}
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
 <div class="modal fade modal-show" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div style="min-width: 95% !important;"  class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
         <div class="modal-header">
             <h4>Product Form Create</h4>
         </div>
         <div class="modal-body">
             <div class="custom-tab">
                 <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                         <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home"
                             aria-selected="true">General information</a>
                         <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile"
                             aria-selected="false">Profile</a>
                         <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact"
                             aria-selected="false">Contact</a>
                     </div>
                 </nav>
                 <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                         <div class="card m-t-30" style="border: none !important">
                             <div class="card-body card-block">
                                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-create-product" name="form-create-product">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="code_id" class=" form-control-label"> Mã code</label>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <input  type="text" id="code_id" name="code_id" placeholder="Mã code (để trống sẽ tự sinh)" class="form-control" value="">
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
                                                    <input  type="text" id="name" name="name" placeholder=" Nhập tên sản phẩm" class="form-control" value="">
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
                                                    <input  type="number" id="standard_stock" name="standard_stock" placeholder="Nhập tồn đinh mức" class="form-control" value="10">
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
                                                    <input type="number" min='0' step="0.5" id="entry_price" name="entry_price" placeholder="Nhập giá nhập" class="form-control input-currency" value="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-4">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="wholesale_price" class=" form-control-label">Giá bán buôn</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="number" min='0' step="0.5" id="wholesale_price" name="wholesale_price" placeholder="Nhập giá bán buôn" class="form-control input-currency" value="120">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-4">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="retail_price" class=" form-control-label">Giá bán lẻ</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="number" min='0' step="0.5" id="retail_price" name="retail_price" placeholder="Nhập giá bán lẻ" class="form-control input-currency" value="">
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
                                                    <textarea id="description" name="description" class="form-control" placeholder="Nhập chi tiết sản phẩm..."></textarea>
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
                                            <img class="m-t-10 up_ava__success" style="width: 100px;" src="" alt="">
                                        </div>
                                    </div>
                                    {{-- Sub images --}}
                                    {{-- <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="sub_avatar" class=" form-control-label">Ảnh phụ</label>
                                        </div>
                                        <div class="col-12 col-md-9 view_sub__avatar">
                                            <input type="file" id="sub_avatar" name="sub_avatar[]" multiple="" class="form-control-file" accept="image/png, image/jpeg, image/jpg">
                                        </div>
                                    </div> --}}
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                 </form>
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
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-save-item">Save</button>
            </div>
         </form> --}}
        </div>
    </div>

    {{-- Modal Unit --}}
    <div class="modal modal-unit fade modal-show" id="modalUnit" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
        <div style="min-width: 30% !important;"  class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Thêm nhanh đơn vị</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal form-create-item" id="form-create-unit" name="form-create-unit">
                        @csrf
                        <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="conversion_unit" class="form-control-label"> Tên đơn vị</label>
                            </div>
                            <div class="col-12 col-md-7 col-conversion_unit">
                                <input  type="text" id="conversion_unit" name="conversion_unit" placeholder="Tên đơn vị" class="form-control" value="">
                            </div> 
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal-unit" data-dismiss="modal" >Hủy</button>
                    <button type="submit" class="btn btn-primary btn-save-item">Lưu</button>
                </div>
            </form>
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
            form: '#form-create-unit',
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
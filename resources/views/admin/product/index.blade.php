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
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="check_all">
                                        </th>
                                        <th>Ảnh đại diện</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Tình trạng</th>
                                        <th>Giá</th>
                                        <th>Thao tác</th>
                                    </tr>
                            </thead>
                            <tbody id="list_product">
                                
                                @foreach($products as $product)
                                <tr class="tr-shadow">
                                    <td><input type="checkbox" name="item[]" value="{{$product->id}}"></td>
                                    <td>
                                        <a href="">
                                            <img style="width: 150px;" src="{{asset($product->path_image)}}" alt="">
                                        </a>
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category_id}}</td>
                                    <td>{{$product->status}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        <div class="table-data-feature justify-content-center">
                                            <a class="item" title="Edit" href="{{route('product.edit', $product->id )}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a data-id = "{{$product->id}}" class="item btn btn-del-item" title="Delete">
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
 <div class="modal fade modal-show" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
 data-backdrop="static" >
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
                                                    <label for="select" class=" form-control-label">Danh mục</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <select  name="category_id" id="select" class="form-control">
                                                        {!!$option!!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-4">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="price" class=" form-control-label">Giá</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="number" min='0' step="0.5" id="price" name="price" placeholder="Nhập giá" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="textarea-input" class=" form-control-label">Chi tiết sản phẩm</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea id="description" name="description" class="form-control" placeholder="Nhập chi tiết sản phẩm..."></textarea>
            
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
                                {{-- <button type="submit" class="btn btn-primary btn-save-item">Save</button>
                                </form> --}}
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
                <button type="button" class="btn btn-primary test">test</button>
            </div>
         {{-- </form> --}}
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
    <!-- Processing JS of this page -->
    {{-- <script src="{{asset('admin/category_public/myCategory.js')}}"></script> --}}
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    <!-- Handle Category page -->
    <script src="{{asset('client/js/categoryController.js')}}"></script>
    <!-- Handle Validate Form -->
    
    <script>
        Validator({
            form: '#form-create-product',
            errorSelector: '.form-error',
            rules: [
                // Validator.isRequired('#name'),
                // Validator.isRequired('#price'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
                createProduct(data);
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
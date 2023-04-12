@extends('admin.index')
@section('title')
    <title>Nhập hàng</title>
@endsection

@section('content')
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
        {{-- @include('admin.partials.action') --}}
        <a type="button" href="{{route('import_export.show', $type_import_export)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-plus-square"></i>List
        </a>
          <div class="row m-t-30">
              <div class="col-md-12">
                <form action="{{route('import_export.store')}}" method="POST" name="form-create-import-product" class="form-create-import-product" id="form-create-import-product">

                    @csrf
                    <div class="title-import-export">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="bill_code" class=" form-control-label">Ngày: </label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <span> {{$now}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="bill_code" class=" form-control-label">Mã HD</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input  type="text" id="bill_code" name="bill_code" placeholder="Tự sinh" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-5">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="partner" class=" form-control-label">Nhà CC</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select  name="partner_id" id="partner" class="form-control">
                                            @foreach($partners as $partner)
                                                <option value="{{$partner->id}}">
                                                    {{$partner->name_partner}}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <!-- DATA TABLE-->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center list-ieProduct justify-content-center">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Đơn vị</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <tr class="tr-shadow">
                                    <td style="width: 30%;">
                                        <input type="hidden" name="type" value="{{$type_import_export}}">
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        <select name="product_id" id="product" class="form-control">
                                            <option value=""></option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}} (SL: {{$product->quantity}})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td> <input style="width: 50px;" type="text" id="unit" name="unit" class="form-control unit" value=""></td>
                                    <td>
                                        <div class="form-check-inline form-check checkbox-size">
                                            @foreach($sizes as $size)
                                                <label style="padding-right: 4px !important;" for="inline-{{$size->name}}" class="form-check-label ">
                                                    <input type="checkbox" id="inline-{{$size->name}}" name="size[]" value="{{$size->size_name}}" class="form-check-input">{{$size->size_name}}
                                                </label>
                                            @endforeach
                                            {{-- <label style="padding-right: 4px !important;" for="inline-1" class="form-check-label ">
                                                <input type="checkbox" id="inline-1" name="size[]" value="1" class="form-check-input">38
                                            </label>
                                            <label style="padding-right: 4px !important;" for="inline-2" class="form-check-label ">
                                                <input type="checkbox" id="inline-2" name="size[]" value="2" class="form-check-input">39
                                            </label>
                                            <label style="padding-right: 4px !important;" for="inline-3" class="form-check-label ">
                                                <input type="checkbox" id="inline-3" name="size[]" value="3" class="form-check-input">40
                                            </label>
                                            <label style="padding-right: 4px !important;" for="inline-4" class="form-check-label ">
                                                <input type="checkbox" id="inline-4" name="size[]" value="4" class="form-check-input">41
                                            </label>
                                            <label style="padding-right: 4px !important;" for="inline-5" class="form-check-label ">
                                                <input type="checkbox" id="inline-5" name="size[]" value="5" class="form-check-input">42
                                            </label>
                                            <label style="padding-right: 4px !important;" for="inline-6" class="form-check-label ">
                                                <input type="checkbox" id="inline-6" name="size[]" value="6" class="form-check-input">43
                                            </label> --}}
                                        </div>
                                    </td>
                                    <td > <input style="width: 60px" min="0" type="number" id="quantity" name="quantity" class="form-control " value="" disabled></td>
                                    
                                    <td><input type="number" id="price" name="price" class="form-control money" value=""></td>
                                    <td><input  type="number" id="total_amount" name="total_amount" class="form-control money total_amount" value=""></td>
                                    <td>
                                        <div class="table-data-feature justify-content-center">
                                            {{-- <a class="item" title="Edit" href="{{route('import_export.edit', $ieProduct->id )}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a data-id = "{{$ieProduct->id}}" class="item btn btn-del-item" href = "{{route('import_export.destroy', $ieProduct->id )}}" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a> --}}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                    <div class="title-import-export mt-4">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="bill_code" class=" form-control-label">Nhân viên: </label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <span> {{Auth::user()->name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Thuế</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="tax_5" class="form-check-label bill_tax_money">
                                                <input type="radio" id="tax_5" name="bill_tax_money" value="5" class="form-check-input">5%
                                            </label>
                                            <label for="tax_8" class="form-check-label  bill_tax_money">
                                                <input type="radio" id="tax_8" name="bill_tax_money" value="8" class="form-check-input">8%
                                            </label>
                                            <label for="tax_10" class="form-check-label bill_tax_money ">
                                                <input type="radio" id="tax_10" name="bill_tax_money" value="10" class="form-check-input">10%
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="bill_into_money" class=" form-control-label">Thành tiền</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input  type="number" id="bill_into_money" name="bill_into_money" placeholder="" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <button type="submit" class="btn au-btn au-btn-icon au-btn--green au-btn--small btn">
                        <i class="zmdi zmdi-plus"></i>Lưu
                    </button>
                </form>

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
    <script src="{{asset('client/js/ImportExportController.js')}}"></script>  

    <script>
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
@extends('admin.index')
@section('title')
    <title>Provider</title>
@endsection

@section('content')
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
        @include('admin.partials.action')
          <div class="row m-t-30">
              <div class="col-md-12">
                @if(!empty($providers))
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
                                  <th>Tên</th>
                                  <th>Địa chỉ</th>
                                  <th>Điện thoại</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody id="list_providers">
                                
                                @foreach($providers as $provider)
                                <tr class="tr-shadow" id="item_{{$provider->id}}">
                                    <td><input type="checkbox" name="item[]" value="{{$provider->id}}"></td>

                                    <td class="desc">
                                        <a href="">
                                            {{$provider->id}}
                                        </a>
                                    </td>

                                    <td>{{$provider->name_partner}}</td>
                                    <td>{{$provider->address}}</td>
                                    <td>{{$provider->tel}}</td>
                                    <td>
                                        <div class="table-data-feature justify-content-center">
                                            <a class="item" title="Edit" href="{{route('provider.edit', $provider->id )}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a data-id = "{{$provider->id}}"  class="item btn btn-del-item" title="Delete">
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
                @empty($providers)
                    No record! 
                    {{-- <button  type="button" class="btn-create-item" data-toggle="modal" data-target="#staticModal"> Create one?</button> --}}
                    <a class="item btn" href="{{route('category.trash')}}"> Go to Trash list</a>
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


<!-- modal static -->
<div class="modal fade modal-show" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
data-backdrop="static" >
   <div  class="modal-dialog modal-sm" role="document">
       <div class="modal-content">
        <div class="modal-header">
            <h4>provider Form Create</h4>
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
                                <form action="{{route('provider.store')}}" method="POST" class="form-horizontal" id="form-create-provider" name="form-create-provider">
                                    @csrf
                                    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="area" class=" form-control-label">Khu vực:</label>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <select required name="area" id="area" class="form-control">
                                                @foreach($areas as $area)
                                                    <option value="{{$area->id}}"> {{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="type_partner" class=" form-control-label">Loại: </label>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <select required name="type_partner" id="type_partner" class="form-control">
                                                @foreach($typePartners as $typePartner)
                                                    <option value="{{$typePartner->id}}"> {{$typePartner->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="name" class=" form-control-label"> Tên:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-name">
                                            <input type="text" id="name" name="name" placeholder="Tên" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="address" class=" form-control-label"> Địa chỉ:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-address">
                                            <input type="text" id="address" name="address" placeholder="Địa chỉ" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="tel" class=" form-control-label"> Điện thoại:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-tel">
                                            <input type="tel" id="tel" name="tel" placeholder="Điện thoại" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="email" class=" form-control-label"> Email:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-email">
                                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="note" class=" form-control-label"> Ghi chú:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-note">
                                            <input type="text" id="note" name="note" placeholder="Ghi chú" class="form-control" value="">
                                        </div>
                                    </div>
                                    {{-- test --}}
                                    {{-- <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="description" class=" form-control-label"> Gender:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-gender">
                                            <input type="radio" name="gender" value="male"> Male
                                            <input type="radio" name="gender" value="female"> Female
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="description" class=" form-control-label"> Gender:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-tag">
                                            <input type="checkbox" name="tag" value="male"> Male
                                            <input type="checkbox" name="tag" value="female"> Female
                                        </div>
                                    </div> --}}
                                {{-- </form> --}}
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
            form: '#form-create-provider',
            errorSelector: '.form-error',
            rules: [
                Validator.isRequired('#area'),
                Validator.isRequired('#type_partner'),
                Validator.isRequired('#name'),
                Validator.isRequired('#address'),
                Validator.isRequired('#tel'),
                Validator.isRequired('#email'),
            ],
            onSubmit: function(data) {
                // Call API
                createProvider(data);
            }

            
        });

        // function create Provider
        function createProvider(data) {
                const providerUrl = 'http://127.0.0.1:8000/admin/provider/';
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
                fetch(providerUrl, options)
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
                        location.reload();
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
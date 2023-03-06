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
                                            <a class="item" title="Edit" href="{{route('category.edit', $category->id )}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a data-id = "{{$category->id}}" class="item btn btn-del-item" title="Delete">
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
            <h4>Category Form Create</h4>
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
                                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-create-category" name="form-create-category">
                                    {{-- @csrf --}}
                                    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
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
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="name" class=" form-control-label"> Name:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-name">
                                            <input type="text" id="name" name="name" placeholder="Name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="description" class=" form-control-label"> Description:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-description">
                                            <textarea type="text" id="description" name="description" placeholder="Description" class="form-control" rows="6"> </textarea>
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
    <!-- Handle Category page -->
    <script src="{{asset('client/js/categoryController.js')}}"></script>
    <script>
        Validator({
            form: '#form-create-category',
            errorSelector: '.form-error',
            rules: [
                Validator.isRequired('#name'),
                Validator.minLength('#name'),
                Validator.isRequired('#description'),
            ],
            onSubmit: function(data) {
                // Call API
                createCaterory(data);
                console.log(data);
            }
        });
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
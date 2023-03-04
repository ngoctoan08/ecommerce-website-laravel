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
                                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form_item" name="frm_add_category">
                                    @csrf
                                    <input type="hidden" id="id" value="">
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
                                            <input type="text" id="name" name="name" placeholder="Name" class="form-control" value="">
                                        </div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="description" class=" form-control-label"> Description:</label>
                                        </div>
                                        <div class="col-12 col-md-7 col-description">
                                            <textarea type="text" id="description" name="description" placeholder="Description" class="form-control" value="" rows="6"> </textarea>
                                        </div>
                                    </div>
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
               <button type="button" class="btn btn-primary btn-save-item">Save</button>
           </div>
        </form>
       </div>
   </div>
</div>
<!-- end modal static -->
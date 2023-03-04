<div class="row form-group mt-3">
    <div class="col-12 col-md-3">
        <select required name="option" id="option" class="form-control">
            @if(url()->current() == route('category.trash'))
                <option value="f_delete"> Force delete</option>
                <option value="restore"> Restore</option>
            @else
                <a type="button" href="{{route('category.trash')}}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                    <option value="delete"> Delete</option>
                </a>
            @endif
        </select>
    </div>
    <div class="col col-md-5">
        <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small btn btn-submit-form disabled">
            <i class="zmdi zmdi-plus"></i>Submit
        </button>
    </div>
</div>
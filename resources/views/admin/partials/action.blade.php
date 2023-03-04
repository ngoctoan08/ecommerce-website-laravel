

{{-- URL TRASH --}}
@if(url()->current() == route('category.trash'))
    <a type="button" href="{{route('category.index')}}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
        <i class="zmdi zmdi-plus"></i>List
    </a>
{{-- URL INDEX --}}
@else
    <button type="button" class="au-btn au-btn-icon au-btn--green au-btn--small btn-create-item" data-toggle="modal" data-target="#staticModal">
        <i class="zmdi zmdi-plus"></i>Create
    </button>

    <button type="button" class="au-btn au-btn-icon au-btn--blue au-btn--small">
        <i class="zmdi zmdi-plus"></i>Import
    </button>
    <a type="button" href="{{route('category.trash')}}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
        <i class="zmdi zmdi-plus"></i>Trash
    </a>
@endif
@extends('admin.index')
@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<div class="main-content">
    <p>Page dashboard, which will show chart about business</p>

</div>
@endsection

@section('js')
    <!-- Alert CDN -->
    <script src="{{asset('admin_template/js/sweetalert.js')}}"></script>
    <!-- Helper Function -->
    <script src="{{asset('admin/js/helper.js')}}"></script>
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    @if(Session::has('message'))
    <script>
        alertSuccess('{{Session::get('message')}}')
    </script>
    @endif
@endsection
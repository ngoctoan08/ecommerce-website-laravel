@extends('layouts.admin')
@section('title')
    <title>Menu</title>
@endsection

@section('content')
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
      <div id="noti"></div>
      <a href="{{route('menu.add')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
          <i class="zmdi zmdi-plus"></i>Add menu</button></a>
          <div class="row m-t-30">
              <div class="col-md-12">
              {{-- <input type="text" name="daterange" class="daterange" value="<?= $firstOfMonthSub.' - '.$toDaySub ?>" />
              <input type="hidden" id="start_date" value="<?=$firstOfMonth?>">
              <input type="hidden" id="end_date" value="<?=$toDay?>"> --}}
                  <!-- DATA TABLE-->
                  <div class="table-responsive table-responsive-data2">
                      <table class="table table-data2 text-center list-menu justify-content-center">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Tên menu</th>
                                  <th>Slug</th>
                                  <th>Parent ID</th>
                                  <th>Thao tác</th>
                              </tr>
                          </thead>
                          <tbody id="list_menu">
                            @foreach($menus as $menu)
                              <tr class="tr-shadow">
                                  <td class="desc">
                                      <a href="">
                                      {{$menu->id}}</td>
                                      </a>
                                      
                                  <td>{{$menu->name}}</td>
                                  <td>{{$menu->slug}}</td>
                                  <td>{{$menu->parent_id}}</td>
                                  <td>
                                      <div class="table-data-feature justify-content-center">
                                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                              <a href="{{route('menu.edit', ['id' => $menu->id] )}}">
                                                  <i class="zmdi zmdi-edit"></i>
                                              </a>
                                          </button>

                                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <a href="{{route('menu.delete', ['id' => $menu->id] )}}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </button>
                                          <!-- del cách 2: sử dụng ajax -->

                                          {{-- <button value="<?=$product['id']?>" id="del_product" class="item"  data-toggle="tooltip" data-placement="top" title="Delete">
                                              <i class="zmdi zmdi-delete"></i>
                                          </button> --}}

                                          <!-- show description -->
                                          
                                          {{-- <button value="<?=$product['id']?>"class="item detail_product"  data-toggle="modal" data-placement="top" title="More" data-target="#more_product">
                                              <i class="fa fa-eye"></i>
                                          </button> --}}
                                          
                                      </div>
                                  </td>
                              </tr>
                            @endforeach
                        
                          </tbody>
                      </table>
                  </div>
                  <!-- END DATA TABLE-->
                  {{$menus->links()}}
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
@extends('layout')
@section('content_layout')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Quản lý danh mục
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ </a></li>
    <li><a href="">Quản lý danh mục</a></li>
  </ol>
</section>
@php
$user = Auth::user();
@endphp
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Quản lý danh mục</h3>
        </div><!-- /.box-header -->
        <div id="message" style="padding: 10px 16px;"></div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Menu code</th>
                <th>Menu Name</th>
                <th>Url name</th>
                <th>Url menu</th>
                <th>Mô tả</th>
                <th>Status</th>
                <th>Show menu</th>
                <th>Level</th>
                <th>Parent menu</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" id="code" placeholder="Menu Code"></td>
                <td><input type="text" id="menu" placeholder="Menu name"></td>
                <td><input type="text" id="nameurl" placeholder="Menu name"></td>
                <td><input type="text" id="url" placeholder="Url"></td>
                <td><input type="text" id="descript" placeholder="Description"></td>
                <td><select id="input-status">
                    <option value="1">Hoạt động</option>
                    <option value="0">Không hoạt động</option>
                  </select></td>
                <td><select id="input-show">
                    <option value="1">Hoạt động</option>
                    <option value="0">Không hoạt động</option>
                  </select></td>
                <td><input type="number" id="level" placeholder="level menu" id="input-level"></td>
                <td>
                  <select id="input-parent">
                    <option value=""></option>
                    @foreach($allMenu as $parent)
                    <option value="{{ $parent->id }}">
                      {{ $parent->object_name }}
                    </option>
                    @endforeach
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          <button class="btn btn-primary" style="display: block; margin: 10px auto; max-width: 100px;" onclick="storeAjax()">Thêm mới</button>
        </div><!-- /.box-body -->
        <div style="text-align: center; font-weight: bold;">Danh sách menu</div>
        @if($allMenu != null)
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>STT</th>
                <th>Menu code</th>
                <th>Menu Name</th>
                <th>Url name</th>
                <th>Url menu</th>
                <th>Mô tả</th>
                <th>Status</th>
                <th>Show menu</th>
                <th>Level</th>
                <th>Parent menu</th>
                <th>Sửa</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allMenu as $url)
              <tr id="{{ $url->id }}" class="menu-detail">
                <td>{{ $url->id }}</td>
                <td><input type="text" value="{{ $url->object_code }}" id="code-{{$url->id}}"></td>
                <td><input type="text" value="{{ $url->menu_name }}" id="menu-{{$url->id}}"></td>
                <td><input type="text" value="{{ $url->object_name }}" id="name-{{$url->id}}"></td>
                <td><input type="text" value="{{ $url->object_url }}" id="url-{{$url->id}}"></td>
                <td><input type="text" value="{{ $url->description }}" id="descr-{{$url->id}}"></td>
                <td><a class="status" id="status-{{ $url->id }}" onclick="update('{{$url->id}}', 1)">
                    @if($url->status)
                    Hoạt động
                    @else
                    Không hoạt động
                    @endif
                  </a></td>
                <td><a class="status" id="show-{{ $url->id }}" onclick="update('{{$url->id}}', 2)">
                    @if($url->show_menu)
                    Hoạt động
                    @else
                    Không hoạt động
                    @endif</a></td>
                <td><input type="number" id="updatelevel-{{$url->id}}" value="{{$url->object_level}}"></td>
                <td>
                  <select name="" id="parent-{{$url->id}}">
                    <option value=""></option>
                    @foreach($allMenu as $parent)
                    @if($parent->id == $url->id)
                    @continue
                    @endif
                    <option value="{{ $parent->id }}" {{($parent->id == $url->parent_id) ? 'selected' : ''}}>
                      {{ $parent->object_name }}
                    </option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <a id="edit-{{$url->id}}" class="btn btn-primary">Sửa</a>
                </td>
                <td>
                  <a class="btn btn-danger" onclick="destroyMenu('{{$url->id}}')" >Xóa</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
        @endif
        <!-- check menu not null -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@php
$idMenu
@endphp
<script type="text/javascript">
  var storeAjax = function() {
    $.ajax({
      url: "{{ route('objects.storeNew') }}",
      method: 'GET',
      data: {
        object_name: $('#nameurl').val(),
        menu_name: $('#menu').val(),
        object_url: $('#url').val(),
        object_code: $('#code').val(),
        description: $('#descript').val(),
        object_level: $('#level').val(),
        parent_id: $('#input-parent').val(),
        status: $('#input-status').val(),
        show_menu: $('#input-show').val()
      },
      success: function(result) {
        $('#message').text(result.message);
      }
    });
  };
  var update = function(idMenu, type) {
    var urlink;
    var model;
    if (type == 2) {
      urlink = "{{ route('update.menu.show') }}";
      model = "#show-";
    } else {
      urlink = "{{ route('update.menu.status') }}";
      model = "#status-";
    }
    $.ajax({
      url: urlink,
      method: 'POST',
      data: {
        id: parseInt(idMenu)
      },
      success: function(result) {
        $('#message').text(result.message);
        model += idMenu;
        if (result.status == 200) {
          var text = null;
          if (result.wish) {
            text = "Hoạt động";
          } else {
            text = "Không hoạt động";
          }
          $(model).text(text);
        }
      }
    });
  };

  var destroyMenu = function(idMenu) {
    $.ajax({
      url: "{{ route('objects.deleteNew') }}",
      method: 'GET',
      data: {
        id: parseInt(idMenu)
      },
      success: function(result) {
        $('#message').text(result.message);
        if (result.status == 200) {          
          $("#" + idMenu).remove();
        }
      }
    });
  } //end function destroyMenu
</script>
@endsection
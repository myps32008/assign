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

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Quản lý danh mục</h3>
        </div><!-- /.box-header -->
        <div id="message"></div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>STT</th>
                <th>Menu code</th>
                <th>Menu name</th>
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
                <td><input type="text" value="{{ $url->object_name }}" id="name-{{$url->id}}"></td>
                <td><input type="text" value="{{ $url->object_url }}" id="url-{{$url->id}}"></td>
                <td><input type="text" value="{{ $url->description }}" id="descr-{{$url->id}}"></td>
                <td><a class="status" id="status-{{ $url->id }}" onclick="update('{{$url->id}}', 1)">
                    @if($url->status)
                    Hiện
                    @else
                    Ẩn
                    @endif
                  </a></td>
                <td><a class="status" id="show-{{ $url->id }}" onclick="update('{{$url->id}}', 2)">
                    @if($url->status)
                    Hiện
                    @else
                    Ẩn
                    @endif</a></td>
                <td></td>
                <td>
                  <select name="" id="parent-{{$url->id}}">
                    @foreach($allMenu as $parent)
                    <option value="{{ $parent->id }}" @php if($parent->id == $url->parent_id)
                      echo "selected";
                      @endphp>
                      {{ $parent->object_name }}
                    </option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <a id="edit-{{$url->id}}" class="btn btn-primary">Sửa</a>
                </td>
                <td>
                  <a class="btn btn-danger" id="delete-{{$url->id}}">Xóa</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@php
$idMenu
@endphp
<script type="text/javascript">
  var update = function(idMenu, type){    
      var urlink;
      var model;
      if (type == 2) {
        urlink = "{{ route('update.menu.show') }}";
        model = "#show-";
      }
      else {
        urlink = "{{ route('update.menu.status') }}";
        model = "#status-";
      }
      $.ajax({
        url: urlink,
        method: 'GET',
        data: {
          id: parseInt(idMenu) 
        },
        success: function(result) {
          $('#message').text(result.message);
          model += idMenu;
          $(model).text(result.wish);
        }
      });
  } 
</script>
@endsection
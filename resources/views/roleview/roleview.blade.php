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
                                <th>Role code</th>
                                <th>Role Name</th>
                                <th>Status</th>
                                <th>Mô tả</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" id="code" placeholder="Role Code"></td>
                                <td><input type="text" id="name" placeholder="Role name"></td>                                
                                <td><select id="input-status">
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Không hoạt động</option>
                                    </select></td>
                                <td><input type="text" id="descript" placeholder="Description"></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" style="display: block; margin: 10px auto; max-width: 100px;" onclick="storeRole()">Thêm mới</button>
                </div><!-- /.box-body -->
                <div style="text-align: center; font-weight: bold;">Danh sách vai trò</div>
                @if($allRole != null)
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Role code</th>
                                <th>Role Name</th>
                                <th>Status</th>
                                <th>Mô tả</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                                <th>Cấp quyền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allRole as $role)
                            <tr id="{{ $role->id }}" class="role-detail">
                                <td>{{ $role->id }}</td>
                                <td><input type="text" value="{{ $role->role_code }}" id="code-{{$role->id}}"></td>
                                <td><input type="text" value="{{ $role->role_name }}" id="name-{{$role->id}}"></td>                                
                                <td><a class="status" id="status-{{ $role->id }}" onclick="updateStatus('{{$role->id}}')">
                                        @if($role->status)
                                        Hoạt động
                                        @else
                                        Không hoạt động
                                        @endif
                                    </a>
                                </td>
                                <td><input type="text" value="{{ $role->description }}" id="descr-{{$role->id}}"></td>
                                <td>
                                    <a id="edit-{{$role->id}}" class="btn btn-primary" onclick="editRole('{{$role->id}}')">Sửa</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" onclick="destroyRole('{{$role->id}}')">Xóa</a>
                                </td>
                                <td><a href="">Cấp quyền</a></td>
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
    var storeRole = function() {
        $.ajax({
            url: "{{ route('role.store') }}",
            method: 'GET',
            data: {
                role_name: $('#name').val(),                
                role_code: $('#code').val(),
                description: $('#descript').val(),                
                status: $('#input-status').val()                
            },
            success: function(result) {
                $('#message').text(result.message);
            }
        });
    };
    var updateStatus = function(idMenu) {        
        var model = '#status-';        
        $.ajax({
            url: "{{ route('role.update.status') }}",
            method: 'GET',
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

    var destroyRole = function(idMenu) {
        $.ajax({
            url: "{{ route('role.delete') }}",
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

    var editRole = function(idMenu) {
        $.ajax({
            url: "{{ route('role.edit') }}",
            method: 'GET',
            data: {
                id: idMenu,                
                role_code: $('#code-' + idMenu).val(),
                role_name: $('#name-' + idMenu).val(),                
                description: $('#descr-' + idMenu).val(),                
            },
            success: function(result) {
                $('#message').text(result.message);
            }
        });
    };
</script>
@endsection
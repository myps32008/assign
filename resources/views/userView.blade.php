@extends('layout')
@section('content_layout')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lý tài khoản
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ </a></li>
        <li><a href="">Quản lý tài khoản</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Quản lý tài khoản</h3>
                </div><!-- /.box-header -->
                <div id="message" style="padding: 10px 16px;"></div>
                <div style="text-align: center; font-weight: bold;">Danh sách tài khoản</div>
                @php
                $currentUser = Auth::user();
                $isAdmin = $currentUser->username == 'administrator';
                @endphp
                @if($allUser != null)
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>User name</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>New Password</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                                @if($isAdmin)
                                <th>Vai trò</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allUser as $user)
                            <tr id="{{ $user->id }}" class="role-detail">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td><input type="text" value="{{ $user->fullname }}" id="name-{{$user->id}}"></td>
                                <td><input type="text" value="{{ $user->email }}" id="email-{{$user->id}}"></td>
                                <td><input type="password" id="password-{{$user->id}}"></td>
                                <td><input type="text" value="{{ $user->address }}" id="address-{{$user->id}}"></td>
                                <td>@if($currentUser->id != $user->id)
                                    <a class="status" id="status-{{ $user->id }}" onclick="updateStatus('{{$user->id}}')">
                                        @if($user->status)
                                        Hoạt động
                                        @else
                                        Không hoạt động
                                        @endif
                                    </a>@endif
                                </td>
                                <td>
                                    <a id="edit-{{$user->id}}" class="btn btn-primary" onclick="editUser('{{$user->id}}')">Sửa</a>
                                </td>
                                <td>
                                    @if($currentUser->id != $user->id)
                                    <a class="btn btn-danger" onclick="destroyUser('{{$user->id}}')">Xóa</a>
                                    @endif
                                </td>
                                
                                <td><a href="{{ route('role_user.index', $user->id) }}">
                                @if($isAdmin)
                                    Phân vai trò
                                @else
                                    Xem vai trò
                                @endif
                                </a></td>                                
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
    var updateStatus = function(idMenu) {
        var model = '#status-';
        $.ajax({
            url: "{{ route('user.status') }}",
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
    var destroyUser = function(idMenu) {
        $.ajax({
            url: "{{ route('user.delete') }}",
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

    var editUser = function(idMenu) {
        $.ajax({
            url: "{{ route('user.edit') }}",
            method: 'GET',
            data: {
                id: idMenu,
                email: $('#email-' + idMenu).val(),
                fullname: $('#name-' + idMenu).val(),
                address: $('#address-' + idMenu).val(),
                password: $('#password-' + idMenu).val()
            },
            success: function(result) {
                $('#message').text(result.message);
            }
        });
    };
</script>
@endsection
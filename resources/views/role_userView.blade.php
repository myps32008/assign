@extends('layout')
@section('content_layout')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Phân quyền User {{$user->username}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Trang chủ </a></li>
        <li><a href="">Phân quyền User {{$user->username}}</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Phân quyền User {{$user->username}}</h3>
                </div><!-- /.box-header -->
                <div id="message" style="padding: 10px 16px;"></div>
                <div style="text-align: center; font-weight: bold;">Danh sách vai trò</div>
                @if($roleView != null)
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Role code</th>
                                <th>Role Name</th>
                                <th>Mô tả</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roleView as $role)
                            <tr id="'{{ $role[0]->id }}'" class="role-detail">
                                <td>{{ $role[0]->id }}</td>
                                <td>{{ $role[0]->role_code }}</td>
                                <td>{{ $role[0]->role_name }}></td>
                                <td>{{ $role[0]->description }}</td>
                                <td>
                                    @php                                    
                                    if('$role[1])')
                                            $txt = "Cho phép";
                                        else
                                            $txt = "Không cho phép";
                                    @endphp
                                    @if(Auth::user()->username == "administrator")
                                    <a class="status" id="status-{{ $role[0]->id }}" onclick="updateStatus('{{$role[0]->id}}')">
                                        {{$txt}}
                                    </a>
                                    @else
                                    <p>{{$txt}}</p>
                                    @endif
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
    var updateStatus = function(idMenu) {
        var model = '#status-';
        $.ajax({
            url: "{{ route('role_user.edit') }}",
            method: 'GET',
            data: {
                idUser: '{{$user->id}}',
                idRole: parseInt(idMenu)
            },
            success: function(result) {
                $('#message').text(result.message);
                model += idMenu;
                if (result.status == 200) {
                    var text = null;
                    if (result.wish) {
                        text = "Cho phép";
                    } else {
                        text = "Không cho phép";
                    }
                    $(model).text(text);
                }
            }
        });
    };
</script>
@endsection
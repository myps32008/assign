@extends('layout')
@section('content_layout')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Thêm mới danh mục
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('category.index') }}" class="active">Quản lý danh mục</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Thêm mới danh mục</h3>
                </div><!-- /.box-header -->
                @isset($message)
                <div>
                    {{ $message }}
                </div>
                @endisset
                <!-- form start -->
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label for="madm">Mã danh mục</label>
                      <input type="text" class="form-control" id="madm" name="madm" placeholder="Mã danh mục">
                    </div>
                    <div class="form-group">
                      <label for="tendm">Tên danh mục</label>
                      <input type="text" class="form-control" id="tendm" name="tendm" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                      <label for="tendm">Mô tả</label>
                      <input type="text" class="form-control" id="mota" name="mota" placeholder="Mô tả">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
@endsection      
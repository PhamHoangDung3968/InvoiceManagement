@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
      <form class="form-inline" role="form" action="{{ URL::to ('/show-NhaCungCap') }}">
        <button type="submit" class="btn btn-danger">Quay lại</button>
  </form>
            <section class="panel">
                <header class="panel-heading">
                    Thêm mới nhà cung cấp
                </header>
                <div class="panel-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo $message;
                      Session::put('message',null);
                    }
                  ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to ('/save-NhaCungCap') }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                            <input type="text" name="Ten_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mã số thuế</label>
                          <input type="text" name="MaSoThue_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea class="form-control" name="DiaChi_NhaCungCap" id="exampleInputPassword1" placeholder="Địa chỉ"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số điện thoại</label>
                          <input type="text" name="SĐT_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="Email_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fax</label>
                      <input type="text" name="Fax_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Fax">
                  </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
  </div>
@endsection
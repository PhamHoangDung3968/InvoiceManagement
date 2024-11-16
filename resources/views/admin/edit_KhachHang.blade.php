@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
              <form action="{{ URL::to ('/show-KhachHang') }}">
                <button type="submit" class="btn btn-danger">Quay lại</button>
            </form>
                <header class="panel-heading">
                    Cập nhật thông tin khách hàng
                </header>
                <?php
                    $message = Session::get('message');
                    if($message){
                      echo $message;
                      Session::put('message',null);
                    }
                  ?>
                <div class="panel-body">
                    @foreach ($item as $items)
                        <div class="position-center">
                        <form role="form" action="{{URL::to ('/update-KhachHang/'.$items->MaKhachHang) }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" value="{{ $items->TenKhachHang }}" name="Ten_KhachHang" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mã số thuế</label>
                          <input type="text" value="{{ $items->MST }}" name="MaSoThue_KhachHang" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea class="form-control" name="DiaChi_KhachHang" id="exampleInputPassword1" >{{ $items->DiaChi }}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số điện thoại</label>
                          <input type="text" value="{{ $items->SDT }}" name="SĐT_KhachHang" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" value="{{ $items->Email }}" name="Email_KhachHang" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số tài khoản ngân hàng</label>
                        <input type="text" value="{{ $items->STK_NganHang }}" name="STK_KhachHang" class="form-control" id="exampleInputEmail1" placeholder="text">
                    </div>
                    @endforeach
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
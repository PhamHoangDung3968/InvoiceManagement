@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <form action="{{ URL::to ('/show-HoaDonDauRa') }}">
                    <button type="submit" class="btn btn-danger">Quay lại</button>
                </form>
                <header class="panel-heading">
                    Thêm hóa đơn mới
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
                        <form role="form" action="{{URL::to ('/save-HoaDonDauRa') }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số hóa đơn</label> 
                          <input type="text" name="SoHoaDon_HoaDonDauRa" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên khách hàng</label>
                        <select name="KhachHang_name" class="form-control m-bot15">
                            @foreach ($HoaDonDauRa as $item)
                                <option>{{ $item->TenKhachHang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phương thức thanh toán</label>
                        <input type="text" name="PTTT_HoaDonDauRa" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
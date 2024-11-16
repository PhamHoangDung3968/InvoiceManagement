@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <form action="{{ URL::to ('/show-HoaDon') }}">
                    <button type="submit" class="btn btn-danger">Quay lại</button>
                </form>
                <header class="panel-heading">
                    Thêm chi tiết hóa đơn mới
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
                        <form role="form" action="{{URL::to ('/save-ChiTietHoaDon') }}" method="post">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Số Hóa đơn</label>
                            <select name="SoHoaDon_ChiTietHoaDon" class="form-control m-bot15">
                                @foreach ($HoaDon as $item)
                                    <option>{{ $item->SHDon }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="TenHH_ChiTietHoaDon">Tên hàng hóa</label>
                            <select name="TenHH_ChiTietHoaDon" class="form-control m-bot15">
                                @foreach ($HangHoa as $item)
                                    <option>{{ $item->TenHangHoa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="text" name="SL_ChiTietHoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Chiết khấu</label> 
                          <input type="text" name="CK_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Thuế suất</label> 
                        <input type="text" name="TS_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
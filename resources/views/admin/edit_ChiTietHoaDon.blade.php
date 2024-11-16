@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                @foreach ($item as $items)
                <form action="{{ URL::to ('/show-ChiTietHoaDon/'.$items->SoHD) }}">
                    <button type="submit" class="btn btn-danger">Quay lại</button>
                </form>
                @endforeach
                <header class="panel-heading">
                    Cập nhật hàng Hóa
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
                        <form role="form" action="{{URL::to ('/update-ChiTietHoaDon/'.$items->id) }}" method="post">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Số Hóa đơn</label>
                            <select name="SoHoaDon_ChiTietHoaDon"  class="form-control m-bot15">
                                    <option>{{ $items->SoHD }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên hàng hóa</label>
                            <select name="TenHH_ChiTietHoaDon"  class="form-control m-bot15">
                                @foreach ($hanghoa as $HH)
                                    <option>{{ $HH->TenHangHoa }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số lượng</label>
                          <input type="text" value="{{ $items->SoLuong }}" name="SL_ChiTietHoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chiết khấu</label>
                            <input type="text" value="{{ $items->ChietKhau }}" name="CK_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thuế suất</label>
                            <input type="text" value="{{ $items->ThueSuat }}" name="TS_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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
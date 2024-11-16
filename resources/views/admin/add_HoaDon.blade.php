@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <form action="{{ URL::to ('/show-HoaDon') }}">
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
                        <form role="form" action="{{URL::to ('/save-HoaDon') }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên hóa đơn</label>
                            <input type="text" name="Ten_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số hóa đơn</label> 
                          <input type="text" name="SoHoaDon_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">File</label>
                        <input type="text" name="File_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên doanh nghiệp</label>
                        <select name="DoanhNghiep_name" class="form-control m-bot15">
                            @foreach ($HoaDon as $item)
                                <option>{{ $item->Ten }}</option>
                            @endforeach  
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phương thức thanh toán</label>
                        <input type="text" name="PTTT_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã cơ quan thuế</label>
                        <input type="text" name="MaThamChieu_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
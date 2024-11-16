@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
              <form action="{{ URL::to ('/show-HoaDon') }}">
                <button type="submit" class="btn btn-danger">Quay lại danh sách hóa đơn</button>
            </form>
                <header class="panel-heading">
                    Cập nhật hóa đơn
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
                        <form role="form" action="{{URL::to ('/update-HoaDon/'.$items->id) }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên hóa đơn</label>
                            <input type="text" value="{{ $items->THDon }}" name="Ten_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số hóa đơn</label>
                          <input type="text" value="{{ $items->SHDon }}" name="SoHoaDon_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">File</label>
                            <input type="text" value="{{ $items->File }}" name="File_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Phương thức thanh toán</label>
                          <input type="text" value="{{ $items->PTTT }}" name="PTTT_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mã cơ quan thuế</label>
                        <input type="text" value="{{ $items->MaThamChieu }}" name="MaThamChieu_HoaDon" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                         @endforeach
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tên doanh nghiệp</label>
                          <select name="DoanhNghiep_name" class="form-control m-bot15">
                                @foreach($DoanhNghiep as $items)
                                  <option>{{ $items->Ten }}</option>
                                @endforeach
                          </select>
                      </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>    
</div>
@endsection
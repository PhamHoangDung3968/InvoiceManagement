@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
              @foreach ($item as $items)
              <form action="{{ URL::to ('/show-HangHoaDoanhNghiep/'.$items->MaHangHoa) }}">
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
                        <form role="form" action="{{URL::to ('/update-HangHoaDoanhNghiep/'.$items->MaHangHoa) }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên hàng hóa</label>
                            <input type="text" value="{{ $items->TenHangHoa }}" name="Ten_HangHoa" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đơn vị tính</label>
                            <input type="text" value="{{ $items->DVT }}" name="DVT_HangHoa" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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
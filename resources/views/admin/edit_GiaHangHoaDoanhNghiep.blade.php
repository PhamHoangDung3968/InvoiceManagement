@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
              @foreach ($item as $items)
              <form action="{{ URL::to ('/show-HangHoaDoanhNghiep/'.$items->Ma_DoanhNghiep) }}">
                <button type="submit" class="btn btn-danger">Quay lại</button>
            </form>
            @endforeach
                <header class="panel-heading">
                    Cập nhật giá hàng Hóa
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
                        <form role="form" action="{{URL::to ('/update-GiaHangHoaDoanhNghiep/'.$items->MaHangHoa) }}" method="post">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Giá hàng hóa</label>
                            <input type="text" value="{{ $items->GiaBan }}" name="GiaBan_HangHoa" class="form-control price_format" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        @endforeach    
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
<script type="text/javascript">
  $('.price_format').simpleMoneyFormat();
</script>
@endsection
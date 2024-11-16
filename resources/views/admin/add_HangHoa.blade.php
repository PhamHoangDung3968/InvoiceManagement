@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <form action="{{ URL::to ('/show-HangHoa') }}">
                    <button type="submit" class="btn btn-danger">Quay lại danh sách hàng hóa</button>
                </form>
                <header class="panel-heading">
                    Thêm mới hàng hóa
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
                        <form role="form" action="{{URL::to ('/save-HangHoa') }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên hàng hóa</label>
                            <input type="text" name="Ten_HangHoa" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Giá bán</label> 
                          <input type="text" name="GiaBan_HangHoa" class="form-control price_format" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Đơn vị tính</label>
                        <input type="text" name="DVT_HangHoa" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                        
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                        <select name="NhaCungCap_name" class="form-control m-bot15">
                            @foreach ($HangHoa as $item)
                                <option>{{ $item->Ten }}</option>
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
<script type="text/javascript">
    $('.price_format').simpleMoneyFormat();
</script>
@endsection
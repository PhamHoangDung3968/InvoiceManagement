@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
              <form action="{{ URL::to ('/show-NhaCungCap') }}">
                <button type="submit" class="btn btn-danger">Quay lại</button>
            </form>
                <header class="panel-heading">
                    Cập nhật nhà cung cấp
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
                        <form role="form" action="{{URL::to ('/update-NhaCungCap/'.$items->id) }}" method="post">
                          {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                            <input type="text" value="{{ $items->Ten }}" name="Ten_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mã số thuế</label>
                          <input type="text" value="{{ $items->MST }}" name="MaSoThue_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea class="form-control" name="DiaChi_NhaCungCap" id="exampleInputPassword1" >{{ $items->DChi }}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số điện thoại</label>
                          <input type="text" value="{{ $items->SDThoai }}" name="SĐT_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" value="{{ $items->DCTDTu }}" name="Email_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fax</label>
                      <input type="text" value="{{ $items->Fax }}" name="Fax_NhaCungCap" class="form-control" id="exampleInputEmail1" placeholder="Fax">
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
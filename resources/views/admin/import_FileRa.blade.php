@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
      <form action="{{ URL::to ('/show-HoaDonDauRa') }}">
        <button type="submit" class="btn btn-danger">Quay lại</button>
    </form>
            <section class="panel">
              @foreach ($hd as $item)
    <header class="panel-heading">
        Upload file hóa đơn đầu ra cho số hóa đơn: {{ $item->SoHoaDon }}
    </header>
    @endforeach
            <div class="panel-body">
                  <?php
                    $message = Session::get('message');
                    if($message){
                      echo $message;
                      Session::put('message',null);
                    }
                  ?>
                    <div class="position-center">
                        @foreach ($hd as $hd)
                        <form role="form" action="{{ URL::to('/import_themDauRa/' . $hd->SoHoaDon) }}" method="post" enctype="multipart/form-data">
                            @csrf
                          <div class="form-group">
                              <label for="exampleInputFile">File input</label>
                              <input type="file" id="exampleInputFile" name="file">
                          </div>
                          <button type="submit" class="btn btn-info">Lưu</button>
                      </form>
                        @endforeach
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
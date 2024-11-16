@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
      <form action="{{ URL::to ('/show-HoaDonDauRa') }}">
        <button type="submit" class="btn btn-danger">Quay lại</button>
    </form>
            <section class="panel">
                <header class="panel-heading">
                    Tải lên Hóa đơn đầu ra
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
                        <form role="form" action="{{ route('import_hoadonDauRa') }}" method="post" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group">
                            <label for="exampleInputFile">Thêm file xml</label>
                            <input type="file" id="exampleInputFile" name="XML_file">
                              @error('XML_file')
                                <p class="text-danger">{{$message}}</p>
                              @enderror
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputFile">Thêm file pdf</label>
                            <input type="file" id="exampleInputFile" name="PDF_file">
                              @error('PDF_file')
                                <p class="text-danger">{{$message}}</p>
                              @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khách hàng
    </div>
    <?php
        $message = Session::get('message');
        if($message){
           echo $message;
        Session::put('message',null);
        }
      ?>
    <div class="row w3-res-tb">
      <form method="GET">
        <div class="col-sm-5 m-b-xs">
        <select name="sort" id="sort" class="input-sm form-control w-sm inline v-middle">
          <option>--lọc dữ liệu--</option>
            <option value="{{ Request::url() }}?sort_by=RS">Reset</option>
            <option value="{{ Request::url() }}?sort_by=A_Z">Lọc theo tên A-Z</option>
        </select>
      </form> <br>   <br> 
      <form action="" class="form-inline" role="form">
        <div class="input-group">
          <input name="key" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="submit">Go!</button>
        </span>      
      </div>
      </form>              
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
          <br><br>
          {{-- <form action="{{ URL::to ('/add-KhachHang') }}">
            <button type="submit" class="btn btn-success">Thêm mới</button>
      </form> --}}
      </div>
    </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên khách hàng</th>
              <th>Mã số thuế</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Số tài khoản ngân hàng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @forelse ($item as $items)
                        <tr>
                            <td>{{ $items->TenKhachHang }}</td>
                            <td>{{ $items->MST }}</td>
                            <td>{{ $items->DiaChi }}</td>
                            <td>{{ $items->SDT }}</td>
                            <td>{{ $items->Email }}</td>
                            <td>{{ $items->STK_NganHang }}</td>
                            <td>
                              <a href="{{URL::to ('/thongke-KhachHang/'.$items->MaKhachHang) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-bar-chart-o text-success text-active"></i>
                            </a>
                              <a href="{{URL::to ('/edit-KhachHang/'.$items->MaKhachHang) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                              </a>
                              <a onclick="return confirm('Bạn có chắc muốn xóa doanh nghiệp này không?')" href="{{URL::to ('/delete-KhachHang/'.$items->MaKhachHang) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                              </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No data found</td>
                        </tr>
                    @endforelse
            </tr>
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-5 text-center">
          </div>
          {{ $item->appends(request()->all())->links() }}
        </div>
      </footer>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#sort').on('change',function(){
            var url = $(this).val();
            if(url){
                window.location=url
            }
            return false;
        });
    });
</script>
@endsection
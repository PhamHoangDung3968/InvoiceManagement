@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách nhà cung cấp
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
          {{-- <form class="form-inline" role="form" action="{{ URL::to ('/add-NhaCungCap') }}">
            <button type="submit" class="btn btn-success">Thêm mới nhà cung cấp</button>
      </form> --}}
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên nhà cung cấp</th>
              <th>Mã số thuế</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Fax</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @forelse ($item as $items)
                        <tr>
                            <td><a href="{{ URL::to('/show-HangHoa/' . $items->id) }}">{{ $items->Ten }}</a></td>
                            <td>{{ $items->MST }}</td>
                            <td>{{ $items->DChi }}</td>
                            <td>{{ $items->SDThoai }}</td>
                            <td>{{ $items->DCTDTu }}</td>
                            <td>{{ $items->Fax }}</td>
                            <td>
                              {{-- <a href="{{ URL::to('/show-HangHoa/' . $items->id) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-eye text-success text-active"></i>
                            </a> --}}
                            <a href="{{URL::to ('/thongke-NhaCungCap/'.$items->id) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-bar-chart-o text-success text-active"></i>
                            </a>
                              <a href="{{URL::to ('/edit-NhaCungCap/'.$items->id) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                              </a>
                              <a onclick="return confirm('Bạn có chắc muốn xóa nhà cung cấp này không?')" href="{{URL::to ('/delete-NhaCungCap/'.$items->id) }}" class="active styling-edit" ui-toggle-class="">
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
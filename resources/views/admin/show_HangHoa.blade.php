@extends('admin_layout')
@section('admin_content')
<script src="{{asset ('public/backend/js/simple.money.format.js') }}"></script>

<form action="{{ URL::to ('/show-NhaCungCap') }}">
  <button type="submit" class="btn btn-danger">Quay lại</button>
</form>
<div class="panel panel-default">
  <div class="panel-heading">
    Thông tin doanh nghiệp
  </div>
  <footer class="panel-footer">
    <div class="row">
      @foreach ($item3 as $items3)
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Tên đơn vị (Company&lsquo; name):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->Ten }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"> Mã số thuế (Tax code):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->MST }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Địa chỉ (Address):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->DChi }}</b></large>
      </div>
      <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm">Số điện thoại (Phone):</large>
      </div>
        <div class="col-sm-5">
        <large class="text-muted inline m-t-sm m-b-sm"><b>{{ $items3->SDThoai }}</b></large>
      </div>
        @endforeach
      </div>  
    </div>
  </footer>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách hàng hóa
      </div>
      <div class="row w3-res-tb">
        <form method="GET">
          <div class="col-sm-5 m-b-xs">
          <select name="sort" id="sort" class="input-sm form-control w-sm inline v-middle">
            <option>--lọc dữ liệu--</option>
            <option value="{{ Request::url() }}?sort_by=RS">Reset</option>
            <option value="{{ Request::url() }}?sort_by=TenHH_A_Z">Theo tên hàng hóa A-Z</option>
            <option value="{{ Request::url() }}?sort_by=GiaTien">Giá từ cao đến thấp</option>
          </select>
        </form>               
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <form action="" class="form-inline" role="form">
            <div class="input-group">
              <input name="key" class="input-sm form-control" placeholder="Search">
              <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="submit">Go!</button>
            </span>
          </div>
          </form>
          {{-- <form action="{{ URL::to ('/add-HangHoa') }}">
                <button type="submit" class="btn btn-success">Thêm mới</button>
          </form> --}}
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Mã hàng hóa</th>
              <th>Tên hàng hóa</th>
              <th>Giá bán</th>
              <th>Đơn vị tính</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @forelse ($item as $items)
                        <tr>
                            <th scope="row">{{ $items->MaHangHoa }}</th>
                            <td>{{ $items->TenHangHoa }}</td>
                            <td class="price_format">{{ $items->GiaBan }}</td>
                            <td>{{ $items->DVT }}</td>
                            <td>
                              <a href="{{URL::to ('/edit-HangHoa/'.$items->MaHangHoa) }}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                              </a>
                              <a onclick="return confirm('Bạn có chắc muốn xóa nhà cung cấp này không?')" href="{{URL::to ('/delete-HangHoa/'.$items->MaHangHoa) }}" class="active styling-edit" ui-toggle-class="">
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
<script type="text/javascript">
  $('.price_format').simpleMoneyFormat();
</script>
@endsection
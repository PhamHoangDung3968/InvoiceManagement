<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class MediumPriorityController extends Controller
{
    //Bảo mật admin
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //In hóa đơn
    // public function print_bill($SoHD){
    //     $this-> AuthLogin();
    //     $pdf = \App::make('dompdf.wrapper');
    //     $pdf ->loadHTML($this->print_bill_convert($SoHD));
    //     return $pdf->stream();
    // }
    // public function print_bill_convert($SoHD) {
    //     $this-> AuthLogin();
    //     $item = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->paginate(10);
    //     $item2 = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->paginate(10);
    //     $makh = DB::table('tbl_hoadon')->where('SHDon', $SoHD)->value('MaDN_id');
    //     $item3 = DB::table('tbl_doanhnghiep')->where('id', $makh)->paginate(10);  
    //     $chitietdonhang = DB::table('tbl_chitiethoadon')->where('SoHD', $SoHD)->value('MaHH_id');
    //     $hh = DB::table('tbl_hanghoa')->where('MaHangHoa', $chitietdonhang)->value('NhaCungCap_id');
    //     $item4 = DB::table('tbl_nhacungcap')->where('id', $hh)->paginate(10);
    //     $output = '
    //         <style>
    //             body {
    //                 font-family: DejaVu Sans;
    //             }
    //             .container {
    //                 text-align: center; /* Căn giữa ngang */
    //             }
    //             .text {
    //                 display: inline-block; /* Hiển thị trên cùng một dòng */
    //                 margin-right: 60px;
    //             }
    //             table, th, td {
    //                 border: 1px solid black;
    //                 border-collapse: collapse;
    //             }
    //         </style>';
    //     foreach ($item2 as $items2){
    //         $output .= '
    //             <h1 style="text-align: center">' . $items2->THDon . '</h1>
    //             <p style="text-align: center">
    //                 Thời gian <b>' . $items2->NLap . '</b><br>
    //                 (BẢN THỂ HIỆN CỦA HÓA ĐƠN ĐIỆN TỬ)<br>
    //                 Số hóa đơn: <b>' . $items2->SHDon . '</b>
    //             </p>';
    //     }
    //     foreach($item4 as $items4){
    //         $output .= '
    //             <hr>
    //             <p>
    //                 Đơn vị bán hàng (Seller) : <b>' . $items4->Ten . '</b><br>
    //                 Mã số thuế (Tax code): <b>' . $items4->MST . '</b><br>
    //                 Địa chỉ (Address): <b>' . $items4->DChi . '</b><br>
    //                 Email: <b>' . $items4->DCTDTu . '</b>
    //             </p>';
    //     }
    //     foreach($item3 as $items3){
    //         $output .= '
    //             <hr>
    //             <p>
    //                 Họ tên người mua hàng (Buyer): <br>
    //                 Tên đơn vị (Company&lsquo; name): <b>' . $items3->Ten . '</b><br>
    //                 Mã số thuế (Tax code): <b>' . $items3->MST . '</b><br>
    //                 Địa chỉ (Address): <b>' . $items3->DChi . '</b><br>
    //                 Số tài khoản (Account No): <b>' . $items3->Ten . '</b><br>
    //                 Hình thức thanh toán (Method of Payment): TM/CK<br>
    //             </p>
    //             <hr>';
    //     }
    //     $output .='
    //     <h3 style="text-align: center">Danh sách đơn hàng</h3>
    //         <table style="width:100%">
    //             <thead>
    //                 <tr>
    //                     <th>Tên hàng hóa, dịch vụ</th>
    //                     <th>Số lượng</th>
    //                     <th>Đơn giá</th>
    //                     <th>Thành tiền</th>
    //                     <th>Thuế suất GTGT</th>
    //                     <th>Tiền thuế GTGT</th>
    //                 </tr>
    //             </thead>
    //             <tbody>';
    //         $total = 0;
    //         $Amount = 0;
    //         $vat = 0;
    //         $AmountWithVat = 0;
    //     foreach ($item as $items) {
    //         $total += $items->ThanhTien;
    //         $Amount += $items->GiaTruocThueGTGT;
    //         $vat += $items->TienThueGTGT;
    //         $AmountWithVat += $items->ThanhTienSauThue;
    //         $output .= '
    //             <tr>
    //                 <td>' . $items->TenHH . '</td>
    //                 <td>' . $items->SoLuong . '</td>
    //                 <td>' . $items->DonGia . '</td>
    //                 <td>' . $items->ThanhTien . '</td>
    //                 <td>' . $items->ThueSuat . '</td>
    //                 <td>' . $items->TienThueGTGT . '</td>
    //             </tr>';
    //     }
    //     $output .= '
    //             </tbody>
    //         </table>
    //         <table style="width:100%">
    //             <thead>
    //                 <tr>
    //                     <th>Tổng số tiền hàng:</th>
    //                     <th>Giá trước thuế GTGT</th>
    //                     <th>Tiền thuế GTGT:</th>
    //                     <th>Thành tiền sau thuế:</th>
    //                 </tr>
    //             </thead>
    //             <tbody>
    //             <tr>
    //                 <td>' . $total . '</td>
    //                 <td>' . $Amount . '</td>
    //                 <td>' . $vat . '</td>
    //                 <td>' . $AmountWithVat . '</td>
    //             </tr>
    //             </tbody>
    //             </table>
    //             <br><br>
    //             <div class="container">
    //     <div class="text"><h5>Người mua hàng (Buyer)</h5></div>
    //     <div class="text"><h5>CƠ QUAN THUẾ</h5></div>
    //     <div class="text"><h5>Đơn vị bán hàng (Seller)</h5></div>
    // </div>';
    //     return $output;
    // }
    

    
    //Thống kê
    public function show_thongke(){
        $this-> AuthLogin();
        $DoanhNghiep_thongke = DB::table('tbl_doanhnghiep')->orderBy('MST','desc')->get();
        $nhacungcap_thongke = DB::table('tbl_nhacungcap')->orderBy('MST','desc')->get();
        $hanghoa_thongke = DB::table('tbl_hanghoa')->orderBy('MaHangHoa','desc')->get();
        $hoadon_thongke = DB::table('tbl_hoadon')->orderBy('SHDon','desc')->get();     
        $hanghoadoanhnghiep_thongke = DB::table('tbl_hanghoadoanhnghiep')->orderBy('MaHangHoa','desc')->get();
        $khachhang_thongke = DB::table('tbl_khachhang')->orderBy('MaKhachHang','desc')->get();
        $hoadon_thongke = DB::table('tbl_hoadondaura')->orderBy('id','desc')->get();
        return view('admin.show_thongke')->with('DoanhNghiep',$DoanhNghiep_thongke)
                                        ->with('NhaCungCap',$nhacungcap_thongke)
                                        ->with('HangHoa',$hanghoa_thongke)
                                        ->with('HoaDon',$hoadon_thongke)
                                        ->with('HangHoaDoanhNghiep',$hanghoadoanhnghiep_thongke)
                                        ->with('KhachHang',$khachhang_thongke)
                                        ->with('HoaDon',$hoadon_thongke);
    }

    //Thống kê khách hàng
    public function thongke_KhachHang($id){
        $item = DB::table('tbl_khachhang')->where('MaKhachHang',$id)->get();
        $thhkh = DB::table('tbl_khachhang')
                ->join('tbl_hoadondaura', 'tbl_khachhang.MaKhachHang', '=', 'tbl_hoadondaura.Ma_KhachHang')
                ->join('tbl_chitiethoadondaura', 'tbl_hoadondaura.SoHoaDon', '=', 'tbl_chitiethoadondaura.SoHoaDon')
                ->where('tbl_khachhang.MaKhachHang', $id)
                ->count('tbl_chitiethoadondaura.SoHoaDon');
        $sotienkh = DB::table('tbl_thongkekhachhang')->where('Ma_KhachHang',$id)->sum(DB::raw('SoTien'));
        return view('admin.thongke_KhachHang',compact('item','sotienkh','thhkh'));
    }

    public function locthongkekhachhang($id){
        $sapxep = $_GET['order'] ?? '';
        $year_get = $_GET['year'] ?? '';
        if (empty($sapxep) || empty($year_get)) {
            return Redirect::to('thongke-KhachHang/'.$id);
        } else {
            $item = DB::table('tbl_khachhang')->where('MaKhachHang',$id)->get();
            $thhkh = DB::table('tbl_khachhang')
                    ->join('tbl_hoadondaura', 'tbl_khachhang.MaKhachHang', '=', 'tbl_hoadondaura.Ma_KhachHang')
                    ->join('tbl_chitiethoadondaura', 'tbl_hoadondaura.SoHoaDon', '=', 'tbl_chitiethoadondaura.SoHoaDon')
                    ->where('tbl_khachhang.MaKhachHang', $id)
                    ->count('tbl_chitiethoadondaura.SoHoaDon');
            $sotienkh = DB::table('tbl_thongkekhachhang')->where('Ma_KhachHang',$id)->sum(DB::raw('SoTien'));
            $year = DB::table('tbl_thongkekhachhang')->selectRaw('YEAR(NLap) as year')->distinct()->pluck('year');
            $tst = DB::table('tbl_thongkekhachhang');
            if ($year_get) {
                $tst = $tst->whereYear('NLap', $year_get);
                $thhkh = DB::table('tbl_khachhang')
                            ->join('tbl_hoadondaura', 'tbl_khachhang.MaKhachHang', '=', 'tbl_hoadondaura.Ma_KhachHang')
                            ->join('tbl_chitiethoadondaura', 'tbl_hoadondaura.SoHoaDon', '=', 'tbl_chitiethoadondaura.SoHoaDon')
                            ->where('tbl_khachhang.MaKhachHang', $id)
                            ->whereYear('tbl_hoadondaura.NLap', $year_get);
            }
            switch ($sapxep) {
                case 'q1':
                    $thhkh = $thhkh->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->count('tbl_chitiethoadondaura.SoHoaDon');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->sum(DB::raw('SoTien'));
                    break;
                case 'q2':
                    $thhkh = $thhkh->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->count('tbl_chitiethoadondaura.SoHoaDon');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->sum(DB::raw('SoTien'));
                    break;
                case 'q3':
                    $thhkh = $thhkh->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->count('tbl_chitiethoadondaura.SoHoaDon');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->sum(DB::raw('SoTien'));
                    break;
                case 'q4':
                    $thhkh = $thhkh->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->count('tbl_chitiethoadondaura.SoHoaDon');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->sum(DB::raw('SoTien'));
                    break;
                default:
                    $thhkh = $thhkh->count('tbl_chitiethoadondaura.SoHoaDon');
                    $tst = $tst->sum(DB::raw('SoTien'));
                    break;
            }
            return view('admin.locthongkekhachhang',compact('item','tst','thhkh'));
        }
    }

    //Thống kê nhà cung cấp
    public function thongke_NhaCungCap($id){
        $item = DB::table('tbl_nhacungcap')->where('id',$id)->get();
        $tncc = DB::table('tbl_nhacungcap')->where('id',$id)->value("Ten");
        $hd = DB::table('tbl_hoadon')->where('TenNCC',$tncc)->value('SHDon');
        $thhncc = DB::table('tbl_nhacungcap')
                ->join('tbl_hoadon', 'tbl_nhacungcap.Ten', '=', 'tbl_hoadon.TenNCC')
                ->join('tbl_chitiethoadon', 'tbl_hoadon.SHDon', '=', 'tbl_chitiethoadon.SoHD')
                ->where('tbl_nhacungcap.id', $id)
                ->count('tbl_chitiethoadon.SoHD');
        $sotienncc = DB::table('tbl_thongkenhacungcap')->where('Ma_NhaCungCap',$id)->sum(DB::raw('SoTien'));
        return view('admin.thongke_NhaCungCap',compact('item','thhncc', 'sotienncc'));
    }

    public function locthongkenhacungcap($id) {
        $sapxep = $_GET['order'] ?? '';
        $year_get = $_GET['year'] ?? '';
        if (empty($sapxep) || empty($year_get)) {
            return Redirect::to('thongke-NhaCungCap/'.$id);
        } else {
            $item = DB::table('tbl_nhacungcap')->where('id',$id)->get();
            $tncc = DB::table('tbl_nhacungcap')->where('id',$id)->value("Ten");
            $hd = DB::table('tbl_hoadon')->where('TenNCC',$tncc)->value('SHDon');
            $thhncc = DB::table('tbl_nhacungcap')
                ->join('tbl_hoadon', 'tbl_nhacungcap.Ten', '=', 'tbl_hoadon.TenNCC')
                ->join('tbl_chitiethoadon', 'tbl_hoadon.SHDon', '=', 'tbl_chitiethoadon.SoHD')
                ->where('tbl_nhacungcap.id', $id)
                ->count('tbl_chitiethoadon.SoHD');
            $year = DB::table('tbl_thongkenhacungcap')->selectRaw('YEAR(NLap) as year')->distinct()->pluck('year');
            $tst = DB::table('tbl_thongkenhacungcap');
            if ($year_get) {
                $tst = $tst->whereYear('NLap', $year_get);
                $thhncc = DB::table('tbl_nhacungcap')
                            ->join('tbl_hoadon', 'tbl_nhacungcap.Ten', '=', 'tbl_hoadon.TenNCC')
                            ->join('tbl_chitiethoadon', 'tbl_hoadon.SHDon', '=', 'tbl_chitiethoadon.SoHD')
                            ->where('tbl_nhacungcap.id', $id)
                            ->whereYear('tbl_hoadon.NLap', $year_get);
            }
            switch ($sapxep) {
                case 'q1':
                    $thhncc = $thhncc->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->count('tbl_chitiethoadon.SoHD');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->sum(DB::raw('SoTien'));
                    break;
                case 'q2':
                    $thhncc = $thhncc->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->count('tbl_chitiethoadon.SoHD');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->sum(DB::raw('SoTien'));
                    break;
                case 'q3':
                    $thhncc = $thhncc->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->count('tbl_chitiethoadon.SoHD');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->sum(DB::raw('SoTien'));
                    break;
                case 'q4':
                    $thhncc = $thhncc->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->count('tbl_chitiethoadon.SoHD');
                    $tst = $tst->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->sum(DB::raw('SoTien'));
                    break;
                default:
                    $thhncc = $thhncc->count('tbl_chitiethoadon.SoHD');
                    $tst = $tst->sum(DB::raw('SoTien'));
                    break;
            }
            return view('admin.locthongkenhacungcap', compact('tst','item','thhncc'));
        }
    }

    //Thống kê doanh thu
    public function thongkedoanhthu() {
        $id = DB::table('tbl_doanhnghiep')->value('id');
        $sotiendauvao = DB::table('tbl_thongkedauvao')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoTien'));
        $sohoadondauvao = DB::table('tbl_hoadon')->count('SHDon');
        $soluongdauvao = DB::table('tbl_thongkedauvao')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoLuong'));
        $soluongnhacungcap = DB::table('tbl_hoadon')->distinct('TenNCC')->count('TenNCC');
        $sotiendaura = DB::table('tbl_thongkedaura')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoTien'));
        $sohoadondaura = DB::table('tbl_hoadondaura')->count('SoHoaDon');
        $soluongdaura = DB::table('tbl_thongkedaura')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoLuong'));
        $soluongkhachhang = DB::table('tbl_hoadondaura')->distinct('Ma_KhachHang')->count('Ma_KhachHang');
        $demVon = DB::table('tbl_thongke')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('TongVon'));
        $demLai = DB::table('tbl_thongke')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('TongLoi'));
        $demNo = $demLai - $demVon;
        $item3 = DB::table('tbl_doanhnghiep')->where('id', $id)->get();  
        return view('admin.thongkedoanhthu', compact('demVon','demLai','demNo','item3','sotiendauvao','sohoadondauvao','soluongdauvao',
                                                    'soluongnhacungcap','sotiendaura','sohoadondaura','soluongdaura','soluongkhachhang'));
    }

    public function locthongkedauvao($id) {
        $sapxep = $_GET['order'] ?? '';
        $year_get = $_GET['year'] ?? '';
        if (empty($sapxep) || empty($year_get)) {
            return Redirect::to('thongkedoanhthu/'.$id);
        } else {
            $sotiendauvao = DB::table('tbl_thongkedauvao')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoTien'));
            $sohoadondauvao = DB::table('tbl_hoadon')->count('SHDon');
            $soluongdauvao = DB::table('tbl_thongkedauvao')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoLuong'));
            $soluongnhacungcap = DB::table('tbl_hoadon')->distinct('TenNCC')->count('TenNCC');
            $sotiendaura = DB::table('tbl_thongkedaura')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoTien'));
            $sohoadondaura = DB::table('tbl_hoadondaura')->count('SoHoaDon');
            $soluongdaura = DB::table('tbl_thongkedaura')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoLuong'));
            $soluongkhachhang = DB::table('tbl_hoadondaura')->distinct('Ma_KhachHang')->count('Ma_KhachHang');
            $demVon = DB::table('tbl_thongke')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('TongVon'));
            $demLai = DB::table('tbl_thongke')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('TongLoi'));
            $item3 = DB::table('tbl_doanhnghiep')->where('id', $id)->get();  
            $demNo = $demLai - $demVon;
            $year = DB::table('tbl_thongkedauvao')->selectRaw('YEAR(NLap) as year')->distinct()->pluck('year');
            $item = DB::table('tbl_thongkedauvao');
            $tsl = DB::table('tbl_thongkedauvao');
            $tshddv = DB::table('tbl_hoadon');
            $slncc = DB::table('tbl_hoadon');
            if ($year_get) {
                $item = $item->whereYear('NLap', $year_get);
                $tsl = $tsl->whereYear('NLap', $year_get);
                $tshddv = $tshddv->whereYear('NLap', $year_get);
                $slncc = $slncc->whereYear('NLap', $year_get);
            }
            switch ($sapxep) {
                case 'q1':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->sum(DB::raw('SoLuong'));
                    $tshddv = $tshddv->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->count('SHDon');
                    $slncc = $slncc->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->distinct('TenNCC')->count('TenNCC');
                    break;
                case 'q2':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->sum(DB::raw('SoLuong'));
                    $tshddv = $tshddv->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->count('SHDon');
                    $slncc = $slncc->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->distinct('TenNCC')->count('TenNCC');
                    break;
                case 'q3':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->sum(DB::raw('SoLuong'));
                    $tshddv = $tshddv->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->count('SHDon');
                    $slncc = $slncc->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->distinct('TenNCC')->count('TenNCC');
                    break;
                case 'q4':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->sum(DB::raw('SoLuong'));
                    $tshddv = $tshddv->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->count('SHDon');
                    $slncc = $slncc->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->distinct('TenNCC')->count('TenNCC');
                    break;
                default:
                    $item = $item->sum(DB::raw('SoTien'));
                    $tsl = $tsl->sum(DB::raw('SoLuong'));
                    $tshddv = $tshddv->count('SHDon');
                    $slncc = $slncc->distinct('TenNCC')->count('TenNCC');
                    break;
            }
            return view('admin.locthongkedauvao', compact('slncc','tshddv','tsl','item','year','demVon','demLai','demNo','item3',
                                                        'sotiendauvao','sohoadondauvao','soluongdauvao','item3','sotiendaura',
                                                        'sohoadondaura','soluongdaura','soluongkhachhang'));
        }
    }

    public function locthongkedaura($id) {
        $sapxep = $_GET['order'] ?? '';
        $year_get = $_GET['year'] ?? '';
        if (empty($sapxep) || empty($year_get)) {
            return Redirect::to('thongkedoanhthu/'.$id);
        } else {
            $sotiendauvao = DB::table('tbl_thongkedauvao')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoTien'));
            $sohoadondauvao = DB::table('tbl_hoadon')->count('SHDon');
            $soluongdauvao = DB::table('tbl_thongkedauvao')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoLuong'));
            $soluongnhacungcap = DB::table('tbl_hoadon')->distinct('TenNCC')->count('TenNCC');
            $sotiendaura = DB::table('tbl_thongkedaura')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoTien'));
            $sohoadondaura = DB::table('tbl_hoadondaura')->count('SoHoaDon');
            $soluongdaura = DB::table('tbl_thongkedaura')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('SoLuong'));
            $soluongkhachhang = DB::table('tbl_hoadondaura')->distinct('Ma_KhachHang')->count('Ma_KhachHang');
            $demVon = DB::table('tbl_thongke')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('TongVon'));
            $demLai = DB::table('tbl_thongke')->where('Ma_DoanhNghiep', $id)->sum(DB::raw('TongLoi'));
            $item3 = DB::table('tbl_doanhnghiep')->where('id', $id)->get();  
            $demNo = $demLai - $demVon;
            $year = DB::table('tbl_thongkedauvao')->selectRaw('YEAR(NLap) as year')->distinct()->pluck('year');
            $item = DB::table('tbl_thongkedaura');
            $tsl = DB::table('tbl_thongkedaura');
            $tshddr = DB::table('tbl_hoadondaura');
            $slkh = DB::table('tbl_hoadondaura');
            if ($year_get) {
                $item = $item->whereYear('NLap', $year_get);
                $tsl = $tsl->whereYear('NLap', $year_get);
                $tshddr = $tshddr->whereYear('NLap', $year_get);
                $slkh = $slkh->whereYear('NLap', $year_get);
            }
            switch ($sapxep) {
                case 'q1':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->sum(DB::raw('SoLuong'));
                    $tshddr = $tshddr->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->count('SoHoaDon');
                    $slkh = $slkh->whereRaw('MONTH(NLap) BETWEEN 1 AND 3')->distinct('Ma_KhachHang')->count('Ma_KhachHang');
                    break;
                case 'q2':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->sum(DB::raw('SoLuong'));
                    $tshddr = $tshddr->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->count('SoHoaDon');
                    $slkh = $slkh->whereRaw('MONTH(NLap) BETWEEN 4 AND 6')->distinct('Ma_KhachHang')->count('Ma_KhachHang');
                    break;
                case 'q3':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->sum(DB::raw('SoLuong'));
                    $tshddr = $tshddr->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->count('SoHoaDon');
                    $slkh = $slkh->whereRaw('MONTH(NLap) BETWEEN 7 AND 9')->distinct('Ma_KhachHang')->count('Ma_KhachHang');
                    break;
                case 'q4':
                    $item = $item->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->sum(DB::raw('SoTien'));
                    $tsl = $tsl->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->sum(DB::raw('SoLuong'));
                    $tshddr = $tshddr->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->count('SoHoaDon');
                    $slkh = $slkh->whereRaw('MONTH(NLap) BETWEEN 10 AND 12')->distinct('Ma_KhachHang')->count('Ma_KhachHang');
                    break;
                default:
                    $item = $item->sum(DB::raw('SoTien'));
                    $tsl = $tsl->sum(DB::raw('SoLuong'));
                    $tshddr = $tshddr->count('SoHoaDon');
                    $slkh = $slkh->distinct('Ma_KhachHang')->count('Ma_KhachHang');
                    break;
            }
            return view('admin.locthongkedaura', compact('slkh','tshddr','tsl','item','year','demVon','demLai','demNo','item3',
                                                        'sotiendauvao','sohoadondauvao','soluongdauvao','item3','sotiendaura',
                                                        'sohoadondaura','soluongdaura','soluongkhachhang','soluongnhacungcap'));
        }
    }
}

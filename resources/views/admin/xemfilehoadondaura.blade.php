<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset ('public/backend/css/bootstrap.min.css') }}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset ('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{asset ('public/backend/css/style-responsive.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset ('public/backend/css/font.css') }}" type="text/css"/>
<link href="{{asset ('public/backend/css/font-awesome.css') }}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset ('public/backend/css/morris.css') }}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset ('public/backend/css/monthly.css') }}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset ('public/backend/js/jquery2.0.3.min.js') }}"></script>
<script src="{{asset ('public/backend/js/raphael-min.js') }}"></script>
<script src="{{asset ('public/backend/js/morris.js') }}"></script>
</head>
<body>
<a class="btn btn-danger" href="{{ URL::to('show-HoaDonDauRa') }}">Quay lại</a>
<iframe width="100%" height="800" src="{{asset ('public/outputs/'.$data->TenFileThem) }}">
</iframe>
{{-- @endforeach --}}
</section>
<!--main content end-->
</section>
</body>
</html>

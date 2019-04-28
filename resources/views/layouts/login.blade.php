<!doctype html>
<html lang="en">
<head>
  <title>Dashboard | Klorofil - Free Bootstrap Dashboard Template</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- CSS -->
  {{ Html::style('/backend/css/bootstrap.min.css') }}
  {{ Html::style('/backend/css/vendor/icon-sets.css') }}
  {{ Html::style('/backend/css/main.min.css') }}

  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  {{ Html::style('/backend/css/demo.css') }}
  {{ Html::style('/backend/css/login.css') }}
  <!-- GOOGLE FONTS -->
   <?php  $setting = \App\Models\Setting::find(1); ?>

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <!-- ICONS -->
  <link rel="shortcut icon" href="{{url('/Uploads/setting/fav/en/'. $setting->fav)}}" type="image/x-icon">
  <link rel="icon" href="{{url('/Uploads/setting/fav/en/'. $setting->fav)}}" type="image/x-icon">

</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- SIDEBAR -->

    <!-- END SIDEBAR -->
    <!-- MAIN -->
    <div class="main" >
      <?php  $setting = \App\Models\Setting::find(1); ?>

      <a href="{{url('/')}}/"><img src="{{url('/Uploads/setting/logo/en/'. $setting->logo)}}" alt=" Logo" class="img-responsive logo" style="max-height:inherit"></a>
      <!-- NAVBAR -->

      <!-- END NAVBAR -->
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
          <!-- OVERVIEW -->
          @yield('content')
        </div>
        <!-- END MAIN CONTENT -->
        <footer>
          <div class="container-fluid">
            <p class="copyright">&copy; 2016. Designed &amp; Crafted by <a href="https://themeineed.com">The Develovers</a></p>
          </div>
        </footer>
      </div>
      <!-- END MAIN -->
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    {{ Html::script('/backend/js/jquery/jquery-2.1.0.min.js') }}
    {{ Html::script('/backend/js/bootstrap/bootstrap.min.js') }}
    {{ Html::script('/backend/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
    {{ Html::script('/backend/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}
    {{ Html::script('/backend/js/plugins/chartist/chartist.min.js') }}
    {{ Html::script('/backend/js/klorofil.min.js') }}
  </body>

  </html>

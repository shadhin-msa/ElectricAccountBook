<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  
@include('admin_res.layouts.head')

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition layout-boxed skin-blue sidebar-mini">
<div class="wrapper">

  @include('admin_res.layouts.header')
  
  @include('admin_res.layouts.left_sidebar')

  @include('includes.messages')

 @section('main-content')
      @show

@include('admin_res.layouts.footer')
  

</div>
<!-- ./wrapper -->


<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>


<script type="text/javascript">
	//Menu drop down based on item link and browser address
      $(document).ready(function() {
          $("#sidebar-menu a").each(function() {

              if (this.href == window.location.href) {
                  $(this).parent().addClass("active"); // add active to li of the current link
                  $(this).parent().parent().parent().addClass("active"); 
                  
              }
          });
      });
  </script>
@section('footer')
	@show

  anything from footer
</body>
</html>
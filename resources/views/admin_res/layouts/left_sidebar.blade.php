
@guest()
@else

@endguest

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">

        <img src="{{-- {{$auth_staff->user->photo}} --}}" class="img-circle" title="{{-- {{$auth_staff->user->name}} --}}"
        >
      </div>
      <div class="pull-left info">
        <p> UserName{{-- {{$auth_staff->user->name}} --}}</p>
        <!-- Status -->
        <small>Admin</small><br/>
        
      </div>
    </div>

  {{--   <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form --> --}}

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" id="sidebar-menu" data-widget="tree">
      {{-- <li class="header">HEADER</li> --}}
      <!-- Optionally, you can add icons to the links -->

      
      <li class=" treeview" >
        <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Product</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" >
          <li class="" ><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i>All products</a></li>
          <li class="" ><a  href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i>Category </a></li>
        </ul>
      </li>
      <li class="" ><a  href="{{ route('area.index') }}"><i class="fa fa-circle-o"></i>Area </a></li>
      <li class="" ><a  href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i>Customers </a></li>
      <li class="" ><a  href="{{ route('delar.index') }}"><i class="fa fa-circle-o"></i>Delars </a></li>
      <li class="" ><a  href="{{ route('stock.index') }}"><i class="fa fa-circle-o"></i>Stock </a></li>
      
      <li class="treeview" >
        <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Payment</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" >
          <li class="" ><a href="{{route('payment.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
          <li class="" ><a  href="{{ route('payment.index') }}"><i class="fa fa-circle-o"></i>History </a></li>
        </ul>
      </li>



      <li class="treeview" >
        <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Invoice</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" >
          <li class="" ><a href="{{route('invoice.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
          <li class="" ><a  href="{{ route('invoice.index') }}"><i class="fa fa-circle-o"></i>History </a></li>
        </ul>
      </li>
      <li class="treeview" >
        <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Replace</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" >
          <li class="" ><a href="{{route('replace.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
          <li class="" ><a  href="{{ route('replace.index') }}"><i class="fa fa-circle-o"></i>History </a></li>
        </ul>
      </li>

      <li class="treeview" >
        <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Reports</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" >
          <li class="" ><a  href="{{route('report.due')}}"><i class="fa fa-circle-o"></i>Due</a></li>
          <li class="" ><a  href="{{route('report.sale')}}"><i class="fa fa-circle-o"></i>Sales</a></li>
          <li class="" ><a  href="{{route('report.customer')}}"><i class="fa fa-circle-o"></i>Customer</a></li>
          <li class="" ><a  href="{{route('report.stock')}}"><i class="fa fa-circle-o"></i>Stock</a></li>
          <li class="" ><a  href="{{route('report.area')}}"><i class="fa fa-circle-o"></i>Area</a></li>
        </ul>
      </li>



     

  </ul>

     
       
  <!-- /.sidebar-menu -->
</section>
  <!-- /.sidebar 
  -->
</aside>

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
    <ul class="sidebar-menu" data-widget="tree">
      {{-- <li class="header">HEADER</li> --}}
      <!-- Optionally, you can add icons to the links -->

      
      
      <li class=" menu-open{{ in_array(\Request::route()->getName(), ['idea.index','tag.index','category.index', 'idea.closed', 'idea.final-closed'])? 'active':'' }}" >
        <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Product</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: block;">
          <li class="" ><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i>All products</a></li>
          <li class="" ><a  href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i>Category </a></li>
        </ul>
      </li>
      <li class="" ><a  href="{{ route('area.index') }}"><i class="fa fa-circle-o"></i>Area </a></li>
      <li class="" ><a  href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i>Customers </a></li>
      <li class="" ><a  href="{{ route('delar.index') }}"><i class="fa fa-circle-o"></i>Delars </a></li>


      {{-- new simple coding for making active class

        // === following js will activate the menu in left side bar based on url ====
          $(document).ready(function() {
              $("#sidebar-menu a").each(function() {
                  if (this.href == window.location.href) {
                      $(this).addClass("active");
                      $(this).parent().addClass("active"); // add active to li of the current link
                      $(this).parent().parent().prev().addClass("active"); // add active class to an anchor
                      $(this).parent().parent().prev().click(); // click the item to make it drop
                  }
              });
          });
        --}}

     

  </ul>
  <!-- /.sidebar-menu -->
</section>
  <!-- /.sidebar 
  -->
</aside>
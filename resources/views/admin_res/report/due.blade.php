@extends("admin_res.app")

@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('footer')

<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- page script -->
<script>
	$(function () {
		$('#example1').DataTable()
		$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
		})
	})
</script>
@endsection

@section('footer')

@endsection

@section("main-content")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Delar
			<small><!-- sub title --></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Forms</a></li>
			<li class="active">Editors</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				
			<!-- /.box-primary -->
			<!-- /.box -->

			<div class="box">
				<div class="box-header">

					<h3 class="box-title">All Dues</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Customer</th>
								<th>Area</th>
								<th>Address</th>
								<th>Mobile</th>
								<th>Total Bill</th>
								<th>Total Paied</th>
								<th>Total Replace</th>
								<th>Due</th>

								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($customers as $customer)
							<tr>
								<td>{{$customer->name}}</td>
								<td>{{$customer->area->name}}</td>	
								<td>{{$customer->address}}</td>
								<td>{{$customer->phone}}</td>
								<td>{{$customer->totalBill}}</td>										
								<td>{{$customer->totalDeposit}}</td>										
								<td>{{$customer->totalReplace}}</td>										
								<td>{{$customer->due}}</td>										

								<td><a href="{{route('payment.create',$customer)}}" class="text-info"> Deposit </a></td>
								
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Customer</th>
								<th>Area</th>
								<th>Address</th>
								<th>Mobile</th>
								<th>Total Bill</th>
								<th>Total Paied</th>
								<th>Total Replace</th>
								<th>Due</th>

								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

		</div>
		<!-- /.col-->
	</div>
	<!-- ./row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
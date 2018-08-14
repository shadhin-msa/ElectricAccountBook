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
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
		})
	})
</script>
@endsection

@section('footer')

<!-- CK Editor -->
<!--
<script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
 <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
-->
@endsection

@section("main-content")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Product
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
				<!-- general form elements -->
				<div class="box box-primary">
					@include('includes.messages')
					<div class="box-header with-border">
						<h3 class="box-title">

							<h3 class="box-title">All Invoices</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Invoice No</th>
										<th>Date</th>
										<th>Customer Name</th>
										<th>Total Bill</th>
										<th>Cash Deposit</th>
										<th>Balance</th>
										<th> -- </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($invoices as $invoice)
									<tr>
										<td>{{$invoice->id}}</td>
										<td>{{$invoice->created_at}}</td>
										<td>{{$invoice->customer->name}}</td>
										<td>{{$invoice->total_bill}}</td>
										<td>{{(float)$invoice->payment->amount}}</td>
										<td>{{(float)$invoice->payment->amount - $invoice->total_bill}}</td>	
										<td><a href="{{ route('invoice.show',$invoice->id) }} ">Cash Memo</a> / <a href="{{ route('invoice.chalan',$invoice->id) }} ">Chalan</a></td>							


									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Invoice No</th>
										<th>Date</th>
										<th>Customer Name</th>
										<th>Total Bill</th>
										<th>Cash Deposit</th>
										<th>Balance</th>
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
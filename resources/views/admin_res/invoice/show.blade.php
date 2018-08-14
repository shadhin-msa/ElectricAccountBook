@extends("admin_res.app")

@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/invoice.css')}}">
<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = '<div Class="print_content">'+document.getElementById(el).innerHTML+"</div>";
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
	}
</script>
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
		<h1>Invoice
			<small><!-- sub title --></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Forms</a></li>
			<li class="active">Editors</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content" id="invoice_show">
		<div class="row">
			<div class="col-md-12" >

				<div class="box box-primary" >

					<div class="box-header with-border">
						
						<h3 class="box-title">
						Invoice Details</h3>
					</div>
					<div class="box-body">
						<!-- general form elements -->
						
						<div class="row-fluid sortable"><!--/span-->
							<div id="invoice_details">

								<div class=" span9">
									<span class="cssclsNoScreen">
										<img  class="class_image_header only-print" src="{{ asset('images/Memo_header.png')}}">
									</span>
									<div class="box-content"><!--/row -->
										<table width="100%" border="0">
											<tr>
												<td width="33%" align="left">Invoice No : {{ $invoice->id}}</td>
												<td width="34%" align="center"><h2>Invoice</h2></td>
												<td width="33%" align="right">Date : {{$invoice->created_at}} </td>
											</tr>
										</table>
										<div class="row-fluid">
											<div class="col-md-6" >
												<table width="100%"  cellpadding="2" style="border: 1px solid">
													<tr>
														<td width="30%"><span class="control-label">Company :</span></td>
														<td width="70%">{{$invoice->customer->name}} </td>
													</tr>
													<tr>
														<td>Address :</td>
														<td>{{$invoice->customer->address}} </td>
													</tr>
													<tr>
														<td>Propiter :</td>
														<td></td>
													</tr>
													<tr>
														<td>Mobile :</td>
														<td>{{$invoice->customer->phone}} </td>
													</tr>
												</table>
											</div>
											<div class="col-md-6">

												<table width="100%"  cellpadding="2" style="border: 1px solid">
													<tr>
														<td width="30%">Created at :</td>
														<td width="70%"> {{ $invoice->created_at}} </td>
													</tr>
													<tr>
														<td>Manufacturer:</td>
														<td>  </td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="row-fluid">
											<div class="col-md-12">
												<table width="100%" border="1" cellpadding="3" cellspacing="2">
													<thead>
														<tr>
															<th width="10%">No</th>
															<th width="40%">Product Name</th>
															<th width="16%">Quantity</th>
															<th width="15%">Price</th>
															<th width="19%">Total</th>
														</tr>
													</thead>   
													<tbody>

														@foreach ($invoice->products as $product)
														{{-- expr --}}


														<tr>
															<td class="center">{{$product->id}} </td>
															<td class="center">{{ $product->name}} </td>
															<td class="td_currency">{{ $product->pivot->quantity}} </td>
															<td class="td_currency">{{ $product->pivot->price}} </td>
															<td class="td_currency">{{ $product->pivot->total}} </td>
														</tr>
														@endforeach

													</tbody>
												</table>

												<table width="247" border="1" align="right" cellpadding="2">
													<tbody>
														<tr>
															<td width="44%">Subtotal</td>
															<td width="41%" class="td_currency">{{ $invoice->subtotal}} </td>
														</tr>
														<tr>
															<td>Commission () %</td>
															<td class="td_currency">{{$invoice->commission}} </td>
														</tr>
														<tr>
															<td><span class="control-label">Total Bill</span></td>
															<td class="td_currency">{{$invoice->total_bill}} </td>
														</tr>
														<tr>
															<td><span class="control-label">Previous Due</span></td>
															<td class="td_currency">{{$invoice->previous_due}} </td>
														</tr>

														<tr>
															<td><span class="control-label">Grand Total</span></td>
															<td class="td_currency">{{ $invoice->grand_total}} </td>
														</tr>
														<tr>
															<td><span class="control-label">Cash Deposit</span></td>
															<td class="td_currency">{{ $invoice->payment->amount}} </td>
														</tr>
														<tr>
															<td>Due: </td>
															<td class="td_currency">{{ $invoice->current_due}}</td>
														</tr>
													</tbody>
												</table>
												<br clear="all" >
											</div>
										</div>


										<span class="only-print">
											<div id="invoice_details_footer ">
												<table width="95%" border="0">
													<tr>
														<td width="20%" style="border-bottom: 1px solid; text-align: center;" align="left"> Customer Sign 
														</td>
														<td width="60%" align="center">Return is not allow</td>
														<td width="20%"  style="border-bottom: 1px solid; text-align: center;" align="right">Seller Sign </td>
													</tr>
													<tr>
														<td><br/></td>
														<td></td>
														<td></td>
													</tr>
												</table>
											</div>
										</span>
									</div>
								</div> 
							</div>
						</div>
						<div class="row-fluid sortable">
							<div id="chalan_details" >

								<div class=" span9">
									<span class="cssclsNoScreen only-print">
										<img class="class_image_header" src="{{ asset('images/Memo_header.png')}}">
									</span>
									<div class="box-content"><!--/row -->
										<table width="100%" border="0">
											<tr>
												<td width="33%" align="left">Chalan No: {{$invoice->id}}</td>
												<td width="34%" align="center"><h2>Chalan</h2></td>
												<td width="33%" align="right">Date:{{$invoice->created_at}} </td>
											</tr>
										</table>
										<div class="row-fluid">
											<div class="col-md-12">

												<table width="100%" border="1" cellpadding="3" cellspacing="2">
													<tbody>
														<tr>
															<td width="9%">Customer:</td>
															<td width="40%">{{$invoice->customer->name}} </td>
															<td width="23%">Invoice No:</td>
															<td width="25%">{{$invoice->id}} </td>
														</tr>
														<tr>
															<td>Address</td>
															<td>{{$invoice->customer->address}} </td>
															<td>Delar No:</td>
															<td>##</td>
														</tr>
														<tr>
															<td>Propiter</td>
															<td>##</td>
															<td>Manufacturer Date:</td>
															<td>##</td>
														</tr>
														<tr>
															<td>Mobile:</td>
															<td>{{$invoice->customer->phone}} </td>
															<td>Manufacturer:</td>
															<td>##</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="col-md-12">

												<table width="100%" border="1" cellpadding="2" cellspacing="2">
													<thead>
														<tr>
															<th width="8%">No</th>
															<th width="40%">Product Name</th>
															<th width="21%">Quantity</th>
															<th width="21%">Measurement</th>

														</tr>
													</thead>   
													<tbody>

														@foreach ($invoice->products as $product)

														<tr>
															<td class="center">{{$product->id}} </td>
															<td class="center">{{ $product->name}} </td>
															<td class="td_currency">##</td>
															<td class="td_currency">## </td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
										
										
										<span class="only-print">
											<div id="Chalan_Details_footer ">
												<table width="95%" border="0">
													<tr>
														<td width="20%" style="border-bottom: 1px solid; text-align: center;" align="left"> Customer Sign 
														</td>
														<td width="60%" align="center"></td>
														<td width="20%"  style="border-bottom: 1px solid; text-align: center;" align="right">Seller Sign </td>
													</tr>
													<tr>
														<td><br/></td>
														<td></td>
														<td></td>
													</tr>
												</table>
											</div>
										</span>
									</div> 
								</div>
							</div>
						</div>
						<div class="row-fluid sortable">
							<div class=" span9">
								<input type="button" class="btn btn-primary" onclick="printContent('invoice_details')" value="Print Cash Memo" />
								<input type="button" class="btn btn-primary" onclick="printContent('chalan_details')" value="Print Chalan" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.col-->
		</div>
		<!-- ./row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@extends("admin_res.app")

@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/invoice.css')}}">

@endsection

@section('footer')
 
<script type="text/javascript">
	@php
	$customers_due = array();
	foreach ($customers as $customer) {
		$customers_due[$customer->id] = $customer->previousDue; 
	}

	$products_detail = array();
	foreach ($products as $product) {
		$products_detail[$product->id] = ['stock'=>$product->stock, 'price'=>$product->price ]; 
	}


	@endphp
	
	var Invoice = {
		symbol: '$',
		dueArray: @php echo json_encode($customers_due) @endphp,
		pArray: @php echo json_encode($products_detail) @endphp,

		init: function(){
			Invoice.update();
			Invoice.uiEvent();
		},
		uiEvent: function(){

			$('#items').on('click','.delete', function(e){
				e.preventDefault();
				$(this).parent().parent().remove();
				Invoice.update();
			});

			$('#items').on('change','.price,.quantity,.selectProduct', function(e){
				Invoice.update();
			});

			$('#commission').on('change', function(e){
				Invoice.update();
			});

			$('#payment_input').on('change', function(e){
				Invoice.update();
			});

			$('#selectCustomer').on('change', function(e){
				var id = $('#selectCustomer').val();
				Invoice.updateDue(id);
			});


			$('#addItemButton').on('click', function(e){
				e.preventDefault();
				Invoice.addItem();
				Invoice.update();
			});
		},
		update: function(){
			var subtotal=0,
			commission=0 ,
			total_commission=0,
			total_vill=0,
			previous_due=0,
			grand_total =0,
			payment=0,
			current_due=0;

			$('#items tr').each(function(){

				var p_id = $('.selectProduct',this).val();
				if(p_id != null){


					
					var price = parseFloat($('.price',this).val());
					var old_p_id = parseInt($('.id',this).val());

					if(isNaN(price) || p_id != old_p_id ){
						price = Invoice.pArray[p_id]['price'];
					}

					var stock = Invoice.pArray[p_id]['stock'];


					var qta = parseInt($('.quantity',this).val());
					if(isNaN(qta)){
						qta = 1
					}

					if(qta > stock){
						qta = stock;
						alert('stock limit crossed');
					}

					// var tax_rate = parseInt($('.tax_rate option:selected',this).val());

					var total_price = price*qta;
					subtotal += total_price;

					// if(tax_rate>0){
					// 	var tax = (total_price*tax_rate)/100;

					// 	var tax_rate_item = taxs[tax_rate] || 0;
					// 	taxs[tax_rate] = tax_rate_item + tax;
					// 	taxable += tax;
					// }

					$('.id',this).html(p_id);
					$('.quantity',this).val(qta);
					$('.price',this).val(parseFloat(price).toFixed(2));
					$('.stock',this).val(parseInt(stock));
					$('.total-price',this).html(Invoice.symbol + parseFloat(total_price).toFixed(2));
				}
			});

			
			commission = parseFloat($('#commission').val());
			if(isNaN(commission)){
				commission = 0;
				$('#commission').val(commission);
			}

			previous_due = parseFloat($('#previous_due2').val()).toFixed(2);
			if(isNaN(previous_due)){
				previous_due = 0.00;
				$('#previous_due2').val(previous_due);
			}

			payment = parseFloat($('#payment_input').val()).toFixed(2);
			if(isNaN(payment)){
				payment = 0;
				$('#payment_input').val(payment);
			}

			total_commission = (subtotal* commission)/100;
			total_bill = subtotal - total_commission;
			grand_total =parseFloat(total_bill)+parseFloat(previous_due);
			current_due = grand_total - payment;
			


			$('#subtotal').val(parseFloat(subtotal).toFixed(2));

			$('#total_commission').val(parseFloat(total_commission).toFixed(2));


			$('#total_bill').val(parseFloat(total_bill).toFixed(2));

			$('#grand_total').val(parseFloat(grand_total).toFixed(2));
			$('#current_due').val(parseFloat(current_due).toFixed(2));


			Invoice.displayDelete();

		},
		addItem: function(){
			var html = '<tr class="item"><td><a href="#" class="delete">x</a></td><td class="id"></td><td><select id="" name="product_id[]" class="form-control selectProduct"><option disabled selected value> -- select an option -- </option>@foreach ($products as $product)<option value="{{$product->id}}">{{$product->name}}</option>@endforeach</select></td><td><input type="number" class="quantity" name="quantity[]" step="1" value="1"></td><td><input disabled="disabled" type="number" class="stock" step="1" value=""></td><td><input type="number" class="price" name="price[]" step="0.01" value=""></td><td class="total-price"></td></tr>';
			$('#items').append(html);
		},
		displayDelete: function(){
			var deleteCnt = $('.delete').length;
			if(deleteCnt > 1){
				$('.delete').show();
			}else{
				$('.delete').hide();
			}
		},
		displayTaxs: function(){
			var taxsCnt = $('#taxs tbody tr').length;
			if(taxsCnt > 0){
				$('.tax-container').show();
			}else{
				$('.tax-container').hide();
			}
		},
		updateDue: function(id){
			$('#previous_due1').html(Invoice.symbol+' ' + parseFloat(Invoice.dueArray[id]).toFixed(2));
			$('#previous_due2').val(parseFloat(Invoice.dueArray[id]).toFixed(2));
			Invoice.update();
		},
		updateProductDetail: function(id){
			$('#previous_due1').html(Invoice.symbol+' ' + parseFloat(Invoice.dueArray[id]).toFixed(2));
		}
	};
	$(document).ready(function(){

	// launc
	Invoice.init();
})
</script>

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
			Invoice
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
			<div class="col-md-12" >

				<div class="box box-primary" >

					<div class="box-header with-border">
						
						<h3 class="box-title">
						Create New invoice </h3>
					</div>
					<div class="box-body" id="invoice-content">
						<!-- general form elements -->

						<div class="container">
							<form method="post" action="{{ route('invoice.store') }}" >
								{{ csrf_field() }}

								<div class="col-lg-6">
									<h2>Invoice #</h2>


									<div class="form-group">
										<label>Invoice Date : </label> {{ date("d/M/Y - h:i:s a")}}
									</div>
									<div class="form-group">
										<label>Customer : </label>
										<select id="selectCustomer" required="required" name="customer_id" class="form-control">
											<option disabled selected value=""> -- select an option -- </option>
											@foreach ($customers as $customer)
											<option 
											@if(old('customer_id') == $customer->id || (isset($payment->customer_id) && $payment->customer_id == $customer->id  )){{'selected="selected"'}}@endif value="{{$customer->id}}"> {{$customer->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label>Previous Due : </label> <span id="previous_due1"> -- </span>
									</div>
								</div>

								<table class="items-table">
									<thead>
										<tr>
											<th><i class="fa fa-gear"></i></th>
											<th>No</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Stock</th>
											<th>Price</th>
											<th>Total price</th>
										</tr>
									</thead>
									<tbody id="items">
										<tr class="item">
											<td><a href="#" class="delete">x</a></td>
											<td class="id"></td>
											<td>
												<select id="" required="required" name="product_id[]" class="form-control selectProduct">
													<option disabled selected value> -- select an option -- </option>
													@foreach ($products as $product)
													<option  value="{{$product->id}}"> {{$product->name}}</option>
													@endforeach
												</select>

											</td>
											<td><input type="number" class="quantity" name="quantity[]" min="0" step="1" value=""></td>
											<td><input disabled="disabled" type="number" class="stock" min="0" step="1" value=""></td>
											<td><input type="number" class="price" name="price[]" min="0.00" step="0.01" value=""></td>

											<td class="total-price"></td>
										</tr>
									</tbody>
								</table>
								<a href="" id="addItemButton">+</a>
								<table class="invoice-totals">
									<tbody>
										<tr>
											<th>Subtotal :</th>
											<td><input id="subtotal"  disabled="disabled" type="text" name="commission" value="$00" /></td>
										</tr>
										<tr>
											<th>Commission % :</th>
											<td><input id="commission" type="number" min="0" step="0.50" name="commission" value="{{old('commission')}}" /></td>
										</tr>
										<tr>
											<th>Commission Amount :</th>
											<td ><input id="total_commission"  disabled="disabled" type="text" value="" /></td>
										</tr>
										<tr>
											<th>Total bill :</th>
											<td><input id="total_bill" disabled="disabled" type="text" name="" value=" 0.00" /></td>
										</tr>
										<tr>
											<th>Previous due :</th>
											<td><input id="previous_due2" disabled="disabled" type="text" name="" value=" 0.00" /></td>
										</tr>

										<tr>
											<th>Grand Total</th>
											<td><input id="grand_total" disabled="disabled" type="text" name="" value=" 0.00" /></td>
										</tr>

										<tr>
											<th>Cash Deposit</th>
											<td><input id="payment_input" type="number" min="0"  name="payment" value='{{old("payment")}}' /></td>
										</tr>

										<tr>
											<th>Current Due</th>
											<td><input id="current_due" disabled="disabled" type="text" name="" value=" 0.00" /></td>
										</tr>
									</tbody>
								</table>
								<table class="invoice-totals" style="margin-left: 50%;">
									<tbody>
										<tr>
											<td>
												<input type="submit" name="submit" class="btn btn-primary" value="Confirm Sale"></td colspan="2">
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
						<div class="bottom">
							<h1><span contenteditable>Additional Notes</span></h1>
							<div contenteditable>
								<p>Any notes?</p>
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
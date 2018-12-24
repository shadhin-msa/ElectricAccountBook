@extends("admin_res.app")

@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('footer')

<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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

        $('.input-daterange').datepicker({
            format: 'yyyy/mm/dd',
            endDate: 'today'
        });
        $('.input-daterange input').each(function() {
            $(this).datepicker();
        });
	})
</script>
@endsection



@section("main-content")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Stock Report
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
						Select</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="{{route('report.stock_post')}}" method="post">
					{{ csrf_field()}}
					<div class="box-body">

						<div class="col-lg-6 col-lg-offset-2 ">

							<div class="col-lg-12">
								<div class="form-group">
									<label>Customer</label>
									<select id="" name="product_id" class="form-control">
										<option disabled selected value> -- select an option -- </option>
                                        <?php
                                            $selected_product_id = null;
                                            $selected_product_id = old('product_id');


                                            if(isset($product)){
                                                $selected_product_id = $product->id;
                                            }

                                            if(!isset($start_date)){                                                    
                                                $start_date = "-- -- --";
                                                $end_date = "-- -- --";
                                            }

                                        ?>
										@foreach ($products as $c)
										<option 
										@if( $selected_product_id == $c->id){{'selected="selected"'}}@endif value="{{$c->id}}"> {{$c->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="form-group">
									<label>Duration</label>
									<div class="input-group input-daterange">

                                        <label>Start Date</label>
                                        <input type="text" name="start_date" class="form-control" autocomplete="off" value="{{$start_date}}">
                                        <div class="input-group-addon">to</div>
                                        <label>End Date</label>
                                        <input type="text" name="end_date" class="form-control" autocomplete="off" value="{{$end_date}}">
                                    </div>
								</div>
							</div>

							
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label for="nameInputText" style="opacity: 0">submit</label><br/>
								<button type="submit" class="btn btn-primary">Submit
								</button>
							</div>
						</div>

					</div>
				</form>
			</div>
			<!-- /.box-primary -->
			<!-- /.box -->
@isset($product)
			<div class="box">
				<div class="box-header">

					<h3 class="box-title">Product</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    <div class=" col-md-offset-2 col-md-8">
                    <table  class="table ">
                        <tbody>
                            <tr>
                                <th>Product Name:</th>
                                <td>{{$product->name}}</td>
                                <th>Duration:</th>
                                <td>{{$start_date}} to {{ $end_date}}</td>
                                
                            </tr>
                            <tr>
                                <th>Purchage Quantity:</th>  
                                <td>{{$purchase_quantity}}</td>
                                
                            </tr>

                            <tr>   
                                <th>Sale Quantity:</th>  
                                <td>{{$sale_quantity}}</td>
                                <th>Replace Quantity:</th>  
                                <td>{{$replace_quantity}}</td>
                                
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
					
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Sales Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Invoice no</th>
                                <th>Date</th>
                                <th>Product id</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)

                           <tr>
                                <td>{{$invoice->id}}</td>
                                <td>{{$invoice->created_at}}</td>
                                <td>{{$invoice->pivot->product_id}}</td>
                                <td>{{$invoice->pivot->price}}</td>
                                <td>{{$invoice->pivot->quantity}}</td>
                                <td>{{$invoice->pivot->total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">New Product Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                         <thead>
                            <tr>
                                <th>Stock no</th>
                                <th>Date</th>
                                <th>Product no</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
                                <th>Recevier</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($stocks as $stock)
                            <tr>
                                <td>{{$stock->id}}</td>
                                <td>{{$stock->created_at}}</td>
                                <td>{{$stock->product_id}}</td>
                                <td>{{$stock->quantity}}</td>
                                <td>{{$stock->suplier}}</td>                                
                                <td>{{$stock->user->name}}</td>                                
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
@endIsset

		</div>
		<!-- /.col-->
	</div>
	<!-- ./row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
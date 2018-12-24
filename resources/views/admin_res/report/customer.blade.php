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
			Customer Report
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
					<form role="form" action="{{route('report.customer_post')}}" method="post">
					{{ csrf_field()}}
					<div class="box-body">

						<div class="col-lg-6 col-lg-offset-2 ">

							<div class="col-lg-12">
								<div class="form-group">
									<label>Customer</label>
									<select id="selectArea" name="customer_id" class="form-control">
										<option disabled selected value> -- select an option -- </option>
                                        <?php
                                            $selected_customer_id = null;
                                            $selected_customer_id = old('customer_id');


                                            if(isset($customer)){
                                                $selected_customer_id = $customer->id;
                                            }

                                            if(!isset($start_date)){                                                    
                                                $start_date = "-- -- --";
                                                $end_date = "-- -- --";
                                            }

                                        ?>
										@foreach ($customers as $c)
										<option 
										@if( $selected_customer_id == $c->id){{'selected="selected"'}}@endif value="{{$c->id}}"> {{$c->name}}</option>
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
@isset($customer)
			<div class="box">
				<div class="box-header">

					<h3 class="box-title">Customer</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    <div class=" col-md-offset-2 col-md-8">
                    <table  class="table ">
                        <tbody>
                            <tr>
                                <th>Customer Name:</th>
                                <td>{{$customer->name}}</td>
                                <th>Total Sale:</th>  
                                <td>{{$customer->total_bill}}</td>
                                
                            </tr>

                            <tr>
                                <th>Propiter:</th>
                                <td>--</td>
                                <th>Total Paied:</th>  
                                <td>{{$customer->total_deposit}}</td>
                                
                            </tr>
                            <tr>
                                <th>Duration:</th>
                                <td>{{$start_date}} > {{ $end_date}}</td>
                                <th>Due:</th>  
                                <td>{{$customer->due}}</td>
                                
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
                                <th>Total</th>
                                <th>Cash</th>
                                <th>Due</th>
                                <th>Customer Totall Due</th>
                                <th>Seller</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)

                           <tr>
                                <td>{{$invoice->id}}</td>
                                <td>{{$invoice->created_at}}</td>
                                <td>{{$invoice->total_bill}}</td>
                                <td>{{$invoice->cash}}</td>
                                <td>{{( ( $invoice->total_bill*1) - (1*$invoice->cash) )}}</td>
                                <td>{{$invoice->current_due}}</td>
                                <td>{{$invoice->user->name}}</td>
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
                    <h3 class="box-title">Cash Deposit Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                         <thead>
                            <tr>
                                <th>Deposit no</th>
                                <th>Date</th>
                                <th>Reason</th>
                                <th>Cash</th>
                                <th>Collector</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->created_at}}</td>
                                <td>{{$payment->reason}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->user->name}}</td>                                
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
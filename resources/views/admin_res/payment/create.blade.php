@extends("admin_res.app")

@section('head')
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('footer')

<!-- bootstrap datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- page script -->
<script>
 //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

</script>
@endsection

@section('footer')

<!-- CK Editor -->
<!--
<script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
 <script>
  $(function () {
    // Replace the <textcustomer id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textcustomer').wysihtml5()
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
			Payment
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
							@isset ($payment)Update @else Add New @endisset Payment
						</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="
					@isset ($payment){{route('payment.update',$payment->id)}}@else{{route('payment.store')}}@endisset" method="post">
					{{ csrf_field()}}

					@isset ($payment)
					{{method_field('put')}}
					@endisset
					<div class="box-body">

						<div class="col-lg-6 col-lg-offset-2 ">

							<div class="col-lg-12">
								<div class="form-group">
									<label>Customer</label>
									<select id="selectCustomer" required="required" name="customer_id" class="form-control">
										<option disabled selected value> -- select an option -- </option>
										@foreach ($customers as $customer)
										<option 
										@if(old('customer_id') == $customer->id || (isset($payment->customer_id) && $payment->customer_id == $customer->id  )){{'selected="selected"'}}@endif value="{{$customer->id}}"> {{$customer->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Previous Due</label>
									<input type="number" min="0.01" disabled="disabled" step="0.01"  class="form-control" value="{{$previous_due}}" placeholder="previous due">
								</div>
							</div>

							{{-- <div class="cl-lg-6">
								<label>Date</label>
								<div class="input-group date">
								  <div class="input-group-addon">
								    <i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" class="form-control pull-right" id="datepicker">
								</div>
							</div> --}}

							<div class="col-lg-6">
								<div class="form-group">
									<label>Cash Deposit Amount</label>
									<input type="number" required="required" name="amount"  min="0.0" step="0.01" class="form-control" value="{{old('amount')}}" placeholder="amount">
									
								</div>
							</div>

							<div class="col-lg-12">
								<div class="form-group">
									<label for="remarkTextarea"></label>
									<textarea rows="3" name="remark" class="form-control" placeholder="Remark or Comments">{{old('remark')}}</textarea>
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
		</div>
		<!-- /.col-->
	</div>
	<!-- ./row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
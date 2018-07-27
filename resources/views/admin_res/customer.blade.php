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
			Customer
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
							@isset ($customer)Update @else Add New @endisset  Customer</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="
					@isset ($customer){{route('customer.update',$customer->id)}}@else{{route('customer.store')}}@endisset" method="post">
					{{ csrf_field()}}

					@isset ($customer)
					{{method_field('put')}}
					@endisset
					<div class="box-body">

						<div class="col-lg-6 col-lg-offset-2 ">

							<div class="col-lg-12">
								<div class="form-group">
									<label for="nameInputText">Name</label>
									<input type="text" required="required" class="form-control" value="@isset ($customer){{$customer->name}}@else{{old('name')}}@endisset" name="name" id="nameInputText" placeholder="Enter Name">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="phoneInputText">Phone</label>
									<input type="tel" required="required" class="form-control" value="@isset ($customer){{$customer->phone}}@else{{old('phone')}}@endisset" name="phone" id="phoneInputText" placeholder="Enter Phone">
								</div>
							</div>
							<div class="col-lg-6">
									<div class="form-group">
										<label>Area</label>
										<select id="selectArea" name="areaId" class="form-control">
											<option disabled selected value> -- select an option -- </option>
											@foreach ($areas as $area)
											<option 
											@if(old('areaId') == $area->id || (isset($customer->areaId) && $customer->areaId == $area->id  )){{'selected="selected"'}}@endif value="{{$area->id}}"> {{$area->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="addressInputText">Address</label>
									<input type="text" required="required" class="form-control" value="@isset ($customer){{$customer->address}}@else{{old('address')}}@endisset" name="address" id="addressInputText" placeholder="Enter Address">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="propiterInputText">Propiter</label>
									<input type="text" required="required" class="form-control" value="@isset ($customer){{$customer->propiter}}@else{{old('propiter')}}@endisset" name="propiter" id="propiterInputText" placeholder="Enter Propiter">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="othersrInputText">Others</label>
									<input type="text"  class="form-control" value="@isset ($customer){{$customer->othersr}}@else{{old('address')}}@endisset" name="others" id="othersInputText" placeholder="Anything else">
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

			<div class="box">
				<div class="box-header">

					<h3 class="box-title">All Customers</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Area</th>
								<th>Address</th>

								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($customers as $customer)
							<tr>
								<td>{{$loop->index+1}}</td>
								<td>{{$customer->name}}</td>
								<td>{{$customer->phone}}</td>
								<td>{{$customer->area->name}}</td>
								<td>{{$customer->address}}</td>								

								<td><a href="{{ route('customer.edit',$customer->id) }}" class="text-info"> <span class=" glyphicon glyphicon-edit"></span></a></td>
								<td>
									
									<form id="delete-form-{{$customer->id}}" action="{{ route('customer.destroy',$customer->id) }}"  method="post">
										{{csrf_field()}}
										{{ method_field('DELETE')}}
									</form>
									<a href="#" onclick="if(confirm('Are you sure, You want to delete this?')){event.preventDefault();document.getElementById('delete-form-{{$customer->id}}').submit();}else{event.preventDefault();}" 
										class="text-danger">
										<span class="  glyphicon glyphicon-trash"></span>
									</a>
									

								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>S.No</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Area</th>
								<th>Address</th>

								<th>Edit</th>
								<th>Delete</th>
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
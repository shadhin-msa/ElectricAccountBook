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
			Stock
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
						@isset($stock)Update @else Add New @endisset  Stock</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="
					@isset ($stock){{route('stock.update',$stock->id)}}@else{{route('stock.store')}}@endisset" method="post">
					{{ csrf_field()}}

					@isset ($stock)
					{{method_field('put')}}
					@endisset
					<div class="box-body">

						<div class="col-lg-6 col-lg-offset-2 ">

							<div class="col-lg-12">
								<div class="form-group">
									<label>Product</label>
									<select id="selectArea" name="product_id" class="form-control">
										<option disabled selected value> -- select an option -- </option>
										@foreach ($products as $product)
										<option 
										@if(old('product_id') == $product->id || (isset($stock->product_id) && $stock->product_id == $product->id  )){{'selected="selected"'}}@endif value="{{$product->id}}"> {{$product->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label for="quantityInputText">Quantity</label>
									<input type="number" min="1" required="required" class="form-control" value="@isset ($stock){{$stock->quantity}}@else{{old('quantity')}}@endisset" name="quantity" id="quantityInputText" placeholder="Enter Name">
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label for="supplierInputText">Supplier</label>
									<input type="text" required="required" class="form-control" value="@isset ($stock){{$stock->supplier}}@else{{old('supplier')}}@endisset" name="supplier" id="supplierInputText" placeholder="Enter Propiter">
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

					<h3 class="box-title">All Stocks</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Supplier</th>
								<th>By</th>

								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($stocks as $stock)
							<tr>
								<td>{{$loop->index+1}}</td>
								<td>{{$stock->product->name}}</td>
								<td>{{$stock->quantity}}</td>
								<td>{{$stock->supplier}}</td>
								<td>{{$stock->user->name}}</td>								

								<td><a href="{{ route('stock.edit',$stock->id) }}" class="text-info"> <span class=" glyphicon glyphicon-edit"></span></a></td>
								<td>
									
									<form id="delete-form-{{$stock->id}}" action="{{ route('stock.destroy',$stock->id) }}"  method="post">
										{{csrf_field()}}
										{{ method_field('DELETE')}}
									</form>
									<a href="#" onclick="if(confirm('Are you sure, You want to delete this?')){event.preventDefault();document.getElementById('delete-form-{{$stock->id}}').submit();}else{event.preventDefault();}" 
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
								<th>Product</th>
								<th>Quantity</th>
								<th>Supplier</th>
								<th>By</th>

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
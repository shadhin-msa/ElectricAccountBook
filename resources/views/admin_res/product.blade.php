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
						@isset($product) Update @else Add New @endisset Product</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="
					@isset ($product){{route('product.update',$product->id)}}@else{{route('product.store')}}@endisset" method="post">
					{{ csrf_field()}}

					@isset ($product)
					{{method_field('put')}}
					@endisset
					<div class="box-body">

						<div class="col-lg-10 col-lg-offset-1 ">
							<div class="col-lg-10">

								<div class="col-lg-12">
									<div class="form-group">
										<label for="nameInputText">Name</label>
										<input type="text" required="required" class="form-control" value="@isset ($product){{$product->name}}@else{{old('name')}}@endisset" name="name" id="nameInputText" placeholder="Enter Name">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label>Category</label>
										<select id="selectCategory" name="categoryId" class="form-control">
											<option disabled selected value> -- select an option -- </option>
											@foreach ($categories as $category)
											<option 
											@if(old('categoryId') == $category->id || (isset($product->categoryId) && $product->categoryId == $category->id  )){{'selected="selected"'}}@endif value="{{$category->id}}"> {{$category->name}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-lg-3">
									<div class="form-group">
										<label for="perunitInputText">Per Unit</label>
										<input type="number" required="required" class="form-control" value="@isset ($product){{$product->perunit}}@else{{old('perunit')}}@endisset" name="perunit" id="perunitInputText" placeholder="Enter Amount Per Unit">
									</div>
								</div>

								{{-- <div class="col-lg-3">
									<div class="form-group">
										<label for="stockInputText">Stock</label>
										<input type="number" required="required" class="form-control" value="@isset ($product){{$product->stock}}@else{{old('stock')}}@endisset" name="stock" id="stockInputText" placeholder="Current stock">
									</div>
								</div> --}}

								<div class="col-lg-3">
									<div class="form-group">
										<label for="priceInputText">Price (tk)</label>
										<input type="number" required="required" class="form-control" min="0.00" step="any" value="@isset ($product){{$product->price}}@else{{old('price')}}@endisset" name="price" id="priceInputText" placeholder="Current Price">
									</div>
								</div>


								<div class="col-lg-12">
									<div class="form-group">
										<label for="descriptionInputText">Description</label>
										<textarea required="required" class="form-control"  name="description" id="descriptionInputText" placeholder="Enter Description" cols="4">@isset ($product){{$product->description}}@else{{old('description')}}@endisset</textarea>
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

					</div>
				</form>
			</div>
			<!-- /.box-primary -->
			<!-- /.box -->

			<div class="box">
				<div class="box-header">

					<h3 class="box-title">All Products</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Name</th>
								<th>Category</th>
								<th>Per Unit</th>
								<th>Stock</th>
								<th>Price</th>
								<th>Description</th>

								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
							<tr>
								<td>{{$loop->index+1}}</td>
								<td>{{$product->name}}</td>
								<td>{{$product->category->name}}</td>
								<td>{{$product->perunit}}</td>
								<td>{{$product->stock}}</td>
								<td>{{$product->price}}</td>
								<td>{{$product->description}}</td>								

								<td><a href="{{ route('product.edit',$product->id) }}" class="text-info"> <span class=" glyphicon glyphicon-edit"></span></a></td>
								<td>
									
									<form id="delete-form-{{$product->id}}" action="{{ route('product.destroy',$product->id) }}"  method="post">
										{{csrf_field()}}
										{{ method_field('DELETE')}}
									</form>
									<a href="#" onclick="if(confirm('Are you sure, You want to delete this?')){event.preventDefault();document.getElementById('delete-form-{{$product->id}}').submit();}else{event.preventDefault();}" 
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
								<th>Category</th>
								<th>Per Unit</th>
								<th>Stock</th>
								<th>Price</th>
								<th>Description</th>

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
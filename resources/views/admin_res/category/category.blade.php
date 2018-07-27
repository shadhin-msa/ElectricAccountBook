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
			Category
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
						<h3 class="box-title">@isset ($category)Update @else Add New @endisset category</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="
					@isset ($category){{route('category.update',$category->id)}}@else{{route('category.store')}}@endisset" method="post">
					{{ csrf_field()}}

					@isset ($category)
					{{method_field('put')}}
					@endisset
					<div class="box-body">

						<div class="col-lg-10 col-lg-offset-2 ">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="nameInputText">Category Name</label>
									<input type="text" required="required" class="form-control" value="@isset ($category){{$category->name}}@else{{old('name')}}@endisset" name="name" id="nameInputText" placeholder="Enter Name">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label>Unit Type </label>
									<select id="unit_type" name="unit_type" class="form-control">
										@php
										$unitTypes[] = ['id'=> 1, 'name'=>'Pice'];
										$unitTypes[] = ['id'=> 2, 'name'=>'Foot'];
										@endphp
										<option disabled selected value> -- select an option -- </option>
										@foreach ($unitTypes as $unitType)
										@php
										echo '='.$unitType['id'];
										@endphp
										<option 
										@if($unitType['id'] == old('unit_type') || (isset($category->unit_type) && $unitType['id'] == $category->unit_type ) ){{'selected="selected"'}}@endif
										 value="{{$unitType['id']}}">{{$unitType['name']}}</option>
										@endforeach

									</select>
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
					<h3 class="box-title">All Categories</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Name</th>
								<th>Unit Type</th>

								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
							<tr>
								<td>{{$loop->index+1}}</td>
								<td>{{$category->name}}</td>
								<th>@if ($category->unit_type != null &&  isset( $unitTypes[($category->unit_type-1)] ) )
									{{ $unitTypes[($category->unit_type-1)]['name']}}
          						@endif</th>

                <td><a href="{{ route('category.edit',$category->id) }}" class="text-info"> <span class=" glyphicon glyphicon-edit"></span></a></td>
                <td>
                	@if ($category->hasIdea)
                	<a href="#" onclick="event.preventDefault();alert('This category has {{$category->totalIdea}} ideas. You can\'t Delete this. ')" 
                		class="text-muted disabled" 
                		title="This category has {{$category->totalIdea}} ideas. You can't Delete this.">
                		<span class="  glyphicon glyphicon-question-sign"></span>
                	</a>
                	@else
                	<form id="delete-form-{{$category->id}}" action="{{ route('category.destroy',$category->id) }}"  method="post">
                		{{csrf_field()}}
                		{{ method_field('DELETE')}}
                	</form>
                	<a href="#" onclick="if(confirm('Are you sure, You want to delete this?')){event.preventDefault();document.getElementById('delete-form-{{$category->id}}').submit();}else{event.preventDefault();}" 
                		class="text-danger">
                		<span class="  glyphicon glyphicon-trash"></span>
                	</a>
                	@endif

                </td>
             </tr>
             @endforeach
          </tbody>
          <tfoot>
          	<tr>
          		<th>S.No</th>
          		<th>Name</th>
          		<th>Total Ideas</th>

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
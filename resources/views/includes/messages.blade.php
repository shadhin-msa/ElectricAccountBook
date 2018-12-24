<style type="text/css">
	.popup-message{
		position: fixed;
		right: 64px; 
		min-width: 325px; 
		top: 51px; 
		z-index: 100; 
		display: block; 
	}

	.flash-message{

	}
	.alert.notification_item{
	  opacity: 0;
	  -webkit-animation: custom_notification 5s ; /* Safari 4.0 - 8.0 */
	  animation: custom_notification 5s ;
	}
</style>

<div class="popup-message">

	<div class="flash-message fadeInRight">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			@if(Session::has('alert-' . $msg))

			<p class=" alert alert-{{ $msg }} fade in notification_item">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			@endif
		@endforeach

		@if (count($errors))
			@foreach($errors->all() as $error)
				<p class=" alert alert-danger fade in notification_item">{{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			@endforeach

		@endif
		
	</div> <!-- end .flash-message -->
</div>



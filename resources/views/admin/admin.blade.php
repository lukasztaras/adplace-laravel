@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('adminmenu')
    <li><a href="{{ url('/admin/tags') }}">Tags</a></li>
    <li><a href="{{ url('/admin/users') }}">Users</a></li>
    <li><a href="{{ url('/admin/adverts') }}">Advertisements</a></li>
@endsection

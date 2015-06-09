@extends('app')

@section('content')
<div class="container">
	<div class="row">
            <div class="col-md-10 col-md-offset-1 validation-errors">
                @if($errors->has())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
                @if(!empty($success))
                    <div>{{ $success }}</div>
                @endif
            </div>
            
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body">
                                    <table class="ads-table">
                                        <tr>
                                            <td>Title</td>
                                            <td>Date Added</td>
                                            <td>Date expires</td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                        </tr>
                                        @foreach($ads as $ad)
                                            <tr>
                                                <td>{{ $ad->title }}</td>
                                                <td>{{ $ad->added }}</td>
                                                <td>{{ $ad->expires }}</td>
                                                <td><a href="{{ url('admin/adverts/edit', $ad->id) }}">Edit</a></td>
                                                <td><a href="{{ url('admin/adverts/delete', $ad->id) }}">Delete</a></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: center"><?php echo $ads->render(); ?></td>
                                        </tr>
                                    </table>
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
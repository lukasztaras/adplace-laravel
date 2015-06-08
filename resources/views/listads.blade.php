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
                                                <td><a href="{{ url('home/ads/edit', $ad->id) }}">Edit</a></td>
                                                <td><a href="{{ url('home/ads/delete', $ad->id) }}">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
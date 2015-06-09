@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Search for Item:</div>

				<div class="panel-body">
                                    <form method="post" class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group" style="text-align: center">
                                            <label class="control-label">What are you looking for </label>
                                            <input type="text" class="btn btn-default" name="name" value="{{ old('name') }}">
                                            <input type="submit" class="btn btn-primary">
					</div>
                                    </form>
				</div>
                                @if (!empty($adverts))
                                    <div class="panel-body">
                                        <table class="tags-table left-align" style="width: 100%">
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Tags</th>
                                                <th style="text-align: center">Open</th>
                                            </tr>
                                            @foreach($adverts as $ad)
                                                <tr>
                                                    <td>{{ $ad->title }}</td>
                                                    <td>{{ substr($ad->description, 0, 100) }}</td>
                                                    <td>{{ $ad->hashtag }}</td>
                                                    <td style="text-align: center"><a href="{{ url('item/'.$ad->id.'_'.str_replace(' ', '_', $ad->title )) }}">View</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                @endif
			</div>
		</div>
	</div>
</div>
@endsection
@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">List of all available tags</div>

				<div class="panel-body">
                                    <form method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <table class="tags-table">
                                            <tr>
                                                <th>Tag name</th>
                                                <th>Is enabled</th>
                                            </tr>
                                            @foreach ($tags as $tag)
                                                <tr>
                                                    <td>{{ $tag->name }}</td>
                                                    <td style="text-align: center">
                                                        <input type="checkbox" name="{{ $tag->id }}" @if ($tag->enabled == 1) {{ 'checked' }} @endif >
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" style="text-align: center"><input type="submit" class="btn btn-info"></td>
                                            </tr>
                                        </table>
                                    </form>
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

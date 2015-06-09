@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">List of all available users</div>

				<div class="panel-body">
                                    <form method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <table class="tags-table center-table" style="width: 100%">
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Created</th>
                                                <th>Enabled</th>
                                            </tr>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                        <input type="checkbox" name="{{ $user->id }}" @if ($user->enabled == 1) {{ 'checked' }} @endif >
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4"><input type="submit" class="btn btn-info"></td>
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

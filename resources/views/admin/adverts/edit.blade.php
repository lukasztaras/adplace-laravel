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
				<div class="panel-heading">Edit existing advertisement</div>

				<div class="panel-body">
                                    <form method="post" class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="adId" value="{{ $ad->id }}">
                                            <table class="ads-table">
                                                <tr>
                                                    <td>Advertisement Title</td>
                                                    <td><input type="text" class="btn btn-default" name="name" style="width: 90%;" value="{{ $ad->title }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td><input type="text" class="btn btn-default" name="desc" style="width: 90%;" value="{{ $ad->description }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>Color</td>
                                                    <td>
                                                        <input type="text" class="btn btn-default" name="color" style="width: 90%;" value="{{ $ad->color }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>
                                                        <input type="text" class="btn btn-default" name="city" style="width: 90%;" value="{{ $ad->city }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hashtags (Comma Separated)</td>
                                                    <td>
                                                        <input type="text" class="btn btn-default" name="hash" style="width: 90%;" value="{{ $ad->hashtag }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style='text-align: center'><input type="submit" class="btn btn-primary"></td>
                                                </tr>
                                            </table>
					</div>
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
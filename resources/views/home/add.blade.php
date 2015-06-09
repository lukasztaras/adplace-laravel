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
				<div class="panel-heading">Create new advertisement</div>

				<div class="panel-body">
                                    <form method="post" class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <table class="ads-table">
                                                <tr>
                                                    <td>Advertisement Title</td>
                                                    <td><input type="text" class="btn btn-default" name="name" style="width: 90%;" value="{{ old('name') }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td><input type="text" class="btn btn-default" name="desc" style="width: 90%;" value="{{ old('desc') }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>Color</td>
                                                    <td>
                                                        <input type="text" class="btn btn-default" name="color" style="width: 90%;" @if ($tags['color'] == 0) {{ 'disabled' }} @endif>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>
                                                        <input type="text" class="btn btn-default" name="city" style="width: 90%;" @if ($tags['city'] == 0) {{ 'disabled' }} @endif>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hashtags (Comma Separated)</td>
                                                    <td>
                                                        <input type="text" class="btn btn-default" name="hash" style="width: 90%;" @if ($tags['hashtag'] == 0) {{ 'disabled' }} @endif>
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
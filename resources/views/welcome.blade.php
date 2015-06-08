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
			</div>
		</div>
	</div>
</div>
@endsection
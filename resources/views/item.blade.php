@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $advert->title }}</div>

				<div class="panel-body">
                                    <table class="ads-table">
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $advert->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>{{ $advert->color }}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{ $advert->city }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hashtags</td>
                                            <td>{{ $advert->hashtag }}</td>
                                        </tr>
                                        <tr>
                                            <td>Seller</td>
                                            <td>{{ $seller->name.', e-mail: '.$seller->email }}</td>
                                        </tr>
                                    </table>
                                </div>
			</div>
		</div>
	</div>
</div>
@endsection
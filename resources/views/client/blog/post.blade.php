@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		@foreach ($postData as $post)
		{{ $post->created_user_id }}
		{{ $post->created_at }}

		{{ $post->title }}

		{{ $post->slug }}
		{{ $post->content }}
		@endforeach
	</div>
	<div class="col-md-8 col-md-offset-2">

	</div>
</div>
@endsection
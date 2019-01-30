@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($postComments as $postComment)
        <div class="row">
            <div class="col-xs-1">
                {{$postComment->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.post-comments.edit', $postComment->id) }}">Edit</a>
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.post-comments.destroy', $postComment->id) }}">Delete</a>
            </div>
            <div class="col-xs-5">
                {{ $postComment->content }}
            </div>
            <div class="col-xs-1">
                {{ $postComment->created_user_id }}
            </div>
            <div class="col-xs-1">
                {{ $postComment->created_at }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $postComments->links() }}
    </div>
@endsection
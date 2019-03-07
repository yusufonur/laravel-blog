@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($pages as $page)
        <div class="row">
            <div class="col-xs-1">
                {{$page->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'pages','data'=>$page,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-5">
                {{ $page->title }}
            </div>
            <div class="col-xs-1">
                {{ $page->created_user_id }}
            </div>
            <div class="col-xs-1">
                {{ $page->created_at }}
            </div>
            <div class="col-xs-1">
                {{ $page->updated_at }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $pages->links() }}
    </div>

@endsection
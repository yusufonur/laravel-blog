@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
                {{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.page-comments.update', $pageComment->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', $pageComment->content, ['class'=>'form-control', 'placeholder'=> u__('admin.content') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent page', u__('admin.parent page')) !!}
                    {{ Form::text('page_id', $pageComment->page_id, ['class'=>'form-control', 'placeholder'=> u__('admin.parent page') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent comment', u__('admin.parent comment')) !!}
                    {{ Form::text('parent_id', $pageComment->parent_id, ['class'=>'form-control', 'placeholder'=> u__('admin.parent comment') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection
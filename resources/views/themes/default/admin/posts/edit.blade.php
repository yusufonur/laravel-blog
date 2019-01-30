@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">

                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Title' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {{ Form::text('text', null, ['class'=>'form-control', 'placeholder'=> 'Slug' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {{ Form::textarea('content', null, ['class'=>'form-control', 'placeholder'=> 'Content' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', 'No comments') !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], 'N') }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection
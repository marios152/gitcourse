@extends('layouts.blog-post')

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead"><i>{{$post->title}}</i></p>
    <p>{{$post->body}}</p>
    <hr>


    @if(Session::has('comment_message'))


        {{session('comment_message')}}

        @endif


    <!-- Blog Comments -->

    @if(Auth::check())

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="form-group">
            {!! Form::label('body','Body') !!}
            {!! Form::textarea('body',null,['class'=>'form-control','rows'=>3])!!}
        </div>
        <div class="form-group">
            {!! Form::submit('Submit Comment',['class'=>'bnt btn-primary']) !!}
        </div>


        {!! Form::close() !!}

    </div>
    @endif
    <hr>

    <!-- Posted Comments -->


@if(count ($comments)>0)
    @foreach($comments as $comment)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
{{--            <img height="64" class="media-object" src="{{$comment->photo}}" alt="">--}}
            <img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small> - {{$comment->created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>


            @if((count($comment->replies) > 0))
                @foreach($comment->replies as $cr )

                    <!-- Nested Comment -->
                    @if(Session::has('reply_message'))

                        {{session('reply_message')}}

                    @endif

                    @if($cr->is_active ==1) {{--make sure the comment is active--}}
                            <div id="nested-comment" class="media">
                                <a class="pull-left" href="#">
                                    <img height="64" class="media-object" src="{{$cr->photo}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Nested Start Bootstrap
                                        <small> - {{$cr->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <p>{{$cr->body}}</p>
                                </div>
                                <div class="comment-reply-container">
                                <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                    <div class="comment-reply col-sm-9">
                                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        <div class="form-group">

                                            {!! Form::label('body','Reply:') !!}
                                            {!! Form::textarea('body',null,['class'=>'form-control','rows'=>2])!!}

                                        </div>
                                        <div class="form-group">
                                            {!! Form::submit('Submit',['class'=>'bnt btn-primary']) !!}
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                 </div>
                             <!-- End Nested Comment -->
                        </div>

                        @endif
                @endforeach
                @elseif((count($comment->replies) == 0))
                <!-- Nested Comment -->
                    @if(Session::has('reply_message'))

                        {{session('reply_message')}}

                    @endif

                    <div id="nested-comment" class="media">

                        <div class="comment-reply-container">
                            <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                            <div class="comment-reply col-sm-9">
                                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                <div class="form-group">

                                    {!! Form::label('body','Reply:') !!}
                                    {!! Form::textarea('body',null,['class'=>'form-control','rows'=>2])!!}

                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Submit',['class'=>'bnt btn-primary']) !!}
                                </div>


                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>

                @else
                    <hi class="text-center">No Replies</hi>

            @endif


        </div>
    </div>
   @endforeach
@endif



@stop


@section('scripts')

    <script>
        $(".comment-reply-container .toggle-reply").click(function(){

            $(this).siblings('.comment-reply').slideToggle('slow');

          /*  $(this).next().slideToggle('slow');*/
        });
    </script>
@stop



{{--errors variable is available publicly in the project--}}
@if(count($errors) > 0 )

    <div class="alert alert-danger">

        <ul>
            @foreach($errors->all() as $err)

                <li>
                    {{$err}}
                </li>

            @endforeach


        </ul>
    </div>

@endif
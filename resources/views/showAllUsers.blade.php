@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach($users as $user)

                @if($userId!=$user->id)
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}}

                        @if(in_array($user->id,$followingIds))
                            <p style="color: red;">Followed already</p>

                        @else
                            <form action="/follow" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" value="{{$userId}}">
                                <input type="hidden" name="following_id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-primary">Follow</button>
                            </form>

                        @endif


                </div>

                <div class="panel-body">
                    {{$user->email}}
                </div>
            </div>
    @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

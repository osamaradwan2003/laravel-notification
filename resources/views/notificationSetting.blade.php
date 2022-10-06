@extends('layouts.app')

@section('content')

    @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
    @endif

    <form action="{{route('notificationSetting')}}" method="post" class="p-5 flex justify-content-center">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    @foreach($channels as $channel)
           <div class="form-group">
               <h3 class="col-form-label col-sm-2 pt-0">{{$channel->channel}}</h3>
               <div class="form-check">
                   <div class="form-check">
                       <input
                           class="form-check-input"
                           type="radio"
                           name="{{$channel->id}}"
                           value="1"
                           id="{{$channel->id}}on"
                           @if($channel->is_active == '1') checked @endif
                       >
                       <label class="form-check-label" for="{{$channel->id}}on">
                           On
                       </label>
                   </div>
                   <div class="form-check">
                       <input
                           class="form-check-input"
                           type="radio"
                           name="{{$channel->id}}"
                           value="0"
                           id="{{$channel->id}}off"
                           @if($channel->is_active == '0') checked @endif
                       >
                       <label class="form-check-label" for="{{$channel->id}}off">
                           Off
                       </label>
                   </div>
               </div>
           </div>
        @endforeach
        <input type="submit" value="Save" class="btn btn-primary"/>
    </form>

@endsection;

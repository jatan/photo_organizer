@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card card-default">
        <div class="card-header">Form</div>
        <div class="card-body">
          <form method="POST" action="{{route('home')}}">
            {{ csrf_field() }}
            <fieldset>
              <label class="h4">Who is in photograph..?</label>
              <div class="row">
                @foreach($people as $value=>$label)
                <div class="col-sm-4">
                  <input type="checkbox" name="people[]" id = "{{$value}}" value="{{$value}}"> 
                  <label for="{{$value}}">
                    {{$label}}
                  </label>
                </div>
                @endforeach
              </div>
            </fieldset>

            <label class="h4">How is Photo taken..?</label>
            <div>
              <select class="col-sm-4" name="photo_type">
                @foreach($photo_types as $value => $label)
                <option value="{{$value}}">{{$label}}</option>
                @endforeach
              </select>
            </div>

            <label class="h4">How is the photo Framed..?</label>
            <div>
              <select class="col-sm-4" name="frame_status">
                @foreach($frame_status as $value => $label)
                <option value="{{$value}}">{{$label}}</option>
                @endforeach
              </select>
            </div>
            <br/>
            <button class="btn btn-primary">Submit</button>


          </form>
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Input Form -->
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card card-default">
        <div class="card-header">Form</div>

        <div class="card-body">
          <form method="POST" name="SubmitData" id="SubmitForm" action="{{route('home')}}">
            {{ csrf_field() }}
            <fieldset>
              <label class="h4">Who is in photograph..?*</label>
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
  <br/>

  <!-- Calculation Block  -->
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card card-default">
        <div class="card-header">Counter</div>
        <div class="card-body">
          <form method = "POST" id = "calculationForm" action="{{route('calculate')}}">
            {{csrf_field()}}
            <div class="row">
              @foreach($people as $value=>$label)
              <div class="col-sm-4">
                <input type="checkbox" name="people[]" id = "Cal_{{$value}}" value="{{$value}}"> 
                <label for="Cal_{{$value}}">
                  {{$label}}
                </label>
              </div>
              @endforeach
            </div>
            <label class="h4">How is Photo taken..?</label>
            <div>
              <select class="col-sm-4" name="photo_type">
                <option value="blank">Select</option>
                @foreach($photo_types as $value => $label)
                <option value="{{$value}}">{{$label}}</option>
                @endforeach
              </select>
            </div>

            <label class="h4">How is the photo Framed..?</label>
            <div>
              <select class="col-sm-4" name="frame_status">
                <option value="blank">Select</option>
                @foreach($frame_status as $value => $label)
                <option value="{{$value}}">{{$label}}</option>
                @endforeach
              </select>
            </div>
            <button class="btn btn-primary"> Calculate</button>
          </form>
          <div class="col sm-12">
            <label class="h1" id="count"> </label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
  <!-- History Block  -->
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card card-default">
        <div class="card-header">History</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>
                  People Tagged In Photos
                </th>
                <th>
                  Frame Status
                </th>
                <th>
                  Photo Taken
                </th>
              </tr>
              @foreach($history as $key=>$value)
              <tr>
                <td>
                  @if($value['me']==1)
                  Me
                  @endif
                  @if($value['wife']==1)
                  Wife
                  @endif
                  @if($value['kids']==1)
                  Kids
                  @endif
                  @if($value['parents']==1)
                  Parents
                  @endif
                  @if($value['pets']==1)
                  Pets
                  @endif
                  @if($value['food']==1)
                  Food
                  @endif
                  @if($value['randoms']==1)
                  Randoms
                  @endif
                </td>
                <td>
                  {{$value['frame_status']}}
                </td>
                <td>
                  {{$value['photo_type']}}

                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Page Scripts -->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
// Ajax Script To calculate Total Pics
  $(function () {
    $('#calculationForm').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '/calculate',
        data: $('#calculationForm').serialize(),
        success: function (data) {
          $('#count').html(data);
          console.log(data); 
        }
      });
    });
  });
</script>

@endsection

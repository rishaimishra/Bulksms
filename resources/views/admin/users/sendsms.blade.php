@extends('layouts.app')

@section('content')
@include('admin.users.sidebar')
<div class="container" style="margin-top:-280px">

    <div class="row justify-content-center">

        <div class="col-md-10">
            @if (session('success'))
            <div class="alert alert-primary" role="alert">
                {{ session('success') }}
            </div>
        @endif



        <form action="{{route('admin.import.send')}}" method="POST">@csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Contact</label>
                        <select class="form-control" id="contactName" name="custname" onChange="onSelectChange(this)">
                          <option value="0" disabled selected>Select User</option>

                         @foreach ($users as $item)
                        <option value="{{$item->id}}">{{ucfirst($item->name)}}</option>
                         @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Number</label>
                        <input type="text" class="form-control" id="numberInput" name="custnumber" />
                        {{-- <select class="form-control" id="numberInput" name="custnumber">


                        </select> --}}
                      </div>


                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Account Type</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="actype">
                        <option value="0" disabled selected>Twilio</option>

                      </select>
                    </div>


                    <div class="form-group">
                        <label class="control-label">Number</label>
                        <select class="form-control" id="account_number" name="account_number">
                            <option value="0" disabled selected>Select Number</option>

                         @foreach ($num as $item)
                        <option value="{{$item->id}}">{{ucfirst($item->name)}}</option>
                         @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Example textarea</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="msg"></textarea>
                    </div>

                    <button type="submit">Submit</button>
                  </form>


        </div>
    </div>
</div>
@endsection

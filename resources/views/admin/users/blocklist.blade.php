@extends('layouts.app')

@section('content')
@include('admin.users.sidebar')
<div class="my-content1">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
    @endif
    @error('error')
    <div class="alert alert-danger" role="alert">
      {{ $message }}
    </div>
    @enderror



    <div class="">



        <div class="">
            <div class="card">


                <div class="card-header">Blacklist Contact</div>

                <div class="card-body">
                <div class="col-md-4 ml-auto">

            <div class="card-body">
              <form  action="{{route('admin.import.blocknumber')}}">

              <div class="input-group">
                <input type="text" name="q" class="form-control" />
                <div class="input-group-append">
                  <input class="btn btn-dark" type="submit" id="button-addon2" value="Search" >
                </div>
              </div>
             </form>
            </div>

           </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>

                                    @can('delete-users')
                  <a
                    class="btn-sm btn btn-danger"
                    href="#"
                    onclick="UnblockUser({{$item->id}})">Delete
                  </a>
                  @endcan
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        {{-- {{ $users->links() }} --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

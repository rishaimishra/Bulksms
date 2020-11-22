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


                <div class="card-header">Users</div>

                <div class="card-body">

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

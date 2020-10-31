@extends('layouts.app')

@section('content')
@include('admin.users.sidebar')
<div class="container" style="margin-top:-480px">

    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">


                <div class="card-header">Users</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{implode(', ',$item->roles()->get()->pluck('name')->toArray())}}</td>
                                <td>
                                    @can('edit-users')
                                    <a href="{{route('admin.users.edit',$item->id)}}" ><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                    @endcan
                                    @can('delete-users')
                                <form action="{{route('admin.users.destroy',$item)}}" method="POST" class="float-left">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                   </form>
                                   @endcan

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')

@include('admin.users.sidebar')




<div class="container" style="margin-top:-260px">


    <div class="row justify-content-center">
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


        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
        @endif

        @if(isset($errors) && $errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
            {{$error}}
            @endforeach
        </div>
        @endif

        @if(Session::has('msg'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('msg') }}</p>
        @endif

        <form action="{{route('admin.import.store')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="form-group">
                <input type="file" name="fileimport" required/>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>
        <button type="button" class="btn btn-primary ml-4 mb-3" data-toggle="modal" data-target="#addContact">
            Add Contact
        </button>
        {{-- <div class="col-md-2"> {{$users->links()}}</div> --}}

    <!-- Modal -->
    <div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('admin.contacts.store')}}" method="POST"> @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="number" name="phone" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Phone">
                            <input type="hidden" name="guest" value="1" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="col-md-10">
        <div class="card">


            <div class="card-header">Users</div>

            <div class="card-body">

                <table id="datatable" class="table">
                    <thead>
                        <tr>

                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $item)
                        <tr>

                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                @can('edit-users')
                            <button id="editButton" data-id="{{$item->id}}" class="btn btn-info">Edit</button>
                             @endcan
                                @can('delete-users')
                                <a href="#" onclick="deleteUser({{$item->id}})">
                                    <span class="btn btn-warning">Delete</span>
                                </a>
                                @endcan

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $users->links() }}



            </div>
        </div>
    </div>

</div>




</div>



{{-- Edit modal starts --}}
<div class="overlay-edit-modal"></div>
<div class="modal-content" id="editModal">
    <form action="{{route('admin.contacts.update', 0)}}" method="POST"> @csrf
        {{method_field('PATCH')}}
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Modal title</h5>
            <button type="button" class="close" onClick="modalToggle()">&times;			</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="editName">Name</label>
                <input type="text" name="name" id="name" class="form-control" id="editName" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="editEmail">Email address</label>
                <input type="email" name="email" id="email" class="form-control" id="editEmail" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="editPhone">Phone</label>
                <input type="number" name="phone" id="phone" class="form-control" id="editPhone" placeholder="Enter Phone">
                <input type="hidden" name="guest" value="1" class="form-control" id="editHidden" placeholder="Enter Phone">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onClick="modalToggle()">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
{{-- edit modal end --}}

@endsection

@extends('layouts.app')

@section('content')
@include('admin.users.sidebar')
<div class="my-content1">

    <div class="">

        @if (session('success'))
            <div class="alert alert-primary" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif


        <div class="card">

            <div class="card-header">Templates</div>

            <div class="card-body">                
                
                <table id="templateTable" class="display">
                    <thead>
                        <tr>
                            <th>S. Id</th>
                            <th>Acc S ID</th>
                            <th>To</th>
                            <th>From</th>
                            <th>Body</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->sid }}</td>
                                <td>{{ $message->accountSid }}</td>
                                <td>{{ $message->to }}</td>
                                <td>{{ $message->from }}</td>
                                <td>{{ htmlspecialchars($message->body) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>

        </div>




    </div>

</div>
@endsection

@extends('layouts.app')

@section('content')
@include('admin.users.sidebar')
<div class="my-content1">


        <div class="">
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

            @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif

            <div class="card">

                <div class="card-header">Autoresponder Keywords</div>

                <div class="card-body">
                    <button type="button" data-toggle="modal" data-target="#addTemplate" class="btn btn-primary my-3">New Keywords</button>
                    <!-- Modal -->
                    <div class="modal fade" id="addTemplate" aria-labelledby="addTemplateLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('admin.autoresponder.keywords.create')}}" method="POST">

                                    @csrf

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label">Keyword</label>
                                            <input type="text" name="keyword" class="form-control" placeholder="Enter Keyword" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Message</label>
                                            <textarea type="text" name="message" rows="8" class="form-control" placeholder="Enter Message" required></textarea>
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

                    <table id="templateTable" class="display">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Keyword</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $autoresponders->count(); $i++)
                                <tr>
                                    <td>
                                        {{ $i + 1 }}
                                        <input type="hidden" value="{{ $autoresponders[$i]->id }}" name="templateId" id="templateId">
                                    </td>
                                    <td>{{ $autoresponders[$i]->keyword }}</td>
                                    <td>{{ $autoresponders[$i]->message }}</td>
                                    <td>
                                        <a href="#" id="editButton" data-id="{{ $autoresponders[$i]->id }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="#" onClick="deleteAutoResponderKeyword({{ $autoresponders[$i]->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

            </div>



            {{-- Edit modal starts --}}
            <div class="overlay-edit-modal"></div>
            <div class="modal-content" id="editTemplateModal">
                <form action="{{ route('admin.autoresponder.keywords.update', 0)}}" method="POST" id="editTemplateForm">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Auto Responder Keyword</h5>
                        <button type="button" class="close" onClick="modalToggle()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editName">Keyword</label>
                            <input type="text" name="keyword" class="form-control" id="editTitle" placeholder="Enter Keyword" required>
                        </div>
                        <div class="form-group">
                            <label for="editKeywordMessage">Message</label>
                            <textarea type="text" name="message" rows="8" class="form-control" id="editKeywordMessage" placeholder="Enter Message" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onClick="modalToggle()">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            {{-- edit modal end --}}
           
        </div>
    </div>
</div>
@endsection

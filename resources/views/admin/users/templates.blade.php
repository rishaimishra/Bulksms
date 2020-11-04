@extends('layouts.app')

@section('content')
@include('admin.users.sidebar')
<div class="container" style="margin-top:-480px">

    <div class="row justify-content-center">

        <div class="col-md-10">

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
                    <button type="button" data-toggle="modal" data-target="#addTemplate" class="btn btn-primary my-3">Add New Template</button>
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
                                <form action="{{route('admin.import.template.create')}}" method="POST"> 
                                
                                    @csrf
                                    
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label">Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select class="form-control" name="type">
                                                <option value="SMS">SMS</option>
                                                <option value="EMAIL">EMAIL</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Text</label>
                                            <textarea type="text" name="text" rows="8" class="form-control" placeholder="Enter Text" required></textarea>
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
                                <th>Title</th>
                                <th>Type</th>
                                <th>Template Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $templates->count(); $i++)
                                <tr>
                                    <td>
                                        {{ $i + 1 }} 
                                        <input type="hidden" value="{{ $templates[$i]->id }}" name="templateId" id="templateId">    
                                    </td>
                                    <td>{{ $templates[$i]->title }}</td>
                                    <td>{{ $templates[$i]->type }}</td>
                                    <td>
                                        <a href="javascript:void(0);" onClick="openViewTemplateModal({{$templates[$i]->id}})">View Template</a>
                                        <input type="hidden" value="{{ $templates[$i]->text }}" name="templateText" id="templateText">
                                    </td>
                                    <td>
                                        <a href="#" id="editButton" data-id="{{ $templates[$i]->id }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="#" onClick="deleteTemplate({{ $templates[$i]->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
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
                <form action="{{ route('admin.import.template.update',0) }}" method="POST" id="editTemplateForm"> 
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Template</h5>
                        <button type="button" class="close" onClick="modalToggle()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editName">Title</label>
                            <input type="text" name="title" class="form-control" id="editTitle" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label for="editType">Type</label>
                            <select class="form-control" id="editType" name="editType">
                                @foreach($types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editText">Text</label>
                            <textarea type="text" name="text" rows="8" class="form-control" id="editText" placeholder="Enter Text" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onClick="modalToggle()">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            {{-- edit modal end --}}

            <div class="modal-content" id="viewTemplateModal">
                <div class="modal-header">HEADEr</div>
                <div class="modal-body">asdsa</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onClick="toggleViewTemplateModal()" data-dismiss="modal">Close</button>
                </div>
            </div>

            


        


        </div>
    </div>
</div>
@endsection

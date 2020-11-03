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
                                                @foreach($types as $type)
                                                    <option value="{{ $type }}">{{ $type }}</option>    
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Title</label>
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
                                <th>Template Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $key => $template)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $template->title }}</td>
                                    <td>{{ $template->text }}</td>
                                    <td>
                                        <a href="javascript::void(0);" id="{{ 'editTemplate_'.$template->id }}" data-id="{{ $template->id }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript::void(0);" onClick="deleteTemplate({{ $template->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
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

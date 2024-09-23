@extends('template.main')
@section('title', 'Student')
@section('content')
<style>
    div.dataTables_wrapper div.dataTables_length select {
    width: 34% !important;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <!-- Button to trigger Add Student Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                                    <i class="fa-solid fa-plus"></i> Add Student
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover text-center" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Subject Name</th>
                                        <th>Marks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->subject_name }}</td>
                                            <td>{{ $data->marks }}</td>
                                            <td>
                                                <!-- Button to trigger modal for editing student -->
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $data->id }}">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </button>

                                                <!-- Modal for editing student -->
                                                <div class="modal fade" id="editStudentModal{{ $data->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editStudentModalLabel{{ $data->id }}">Edit Student</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/student/{{ $data->id }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group text-start">
                                                                        <label for="modalName{{ $data->id }}">Name</label>
                                                                        <input type="text" name="name" class="form-control" id="modalName{{ $data->id }}" value="{{ $data->name }}" required>
                                                                    </div>
                                                                    <div class="form-group text-start">
                                                                        <label for="modalSubjectName{{ $data->id }}">Subject Name</label>
                                                                        <input type="text" name="subject_name" class="form-control" id="modalSubjectName{{ $data->id }}" value="{{ $data->subject_name }}" required>
                                                                    </div>
                                                                    <div class="form-group text-start">
                                                                        <label for="modalMarks{{ $data->id }}">Marks</label>
                                                                        <input type="number" name="marks" class="form-control" id="modalMarks{{ $data->id }}" value="{{ $data->marks }}" required>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-success">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form class="d-inline" action="/student/{{ $data->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" id="btn-delete"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/student" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="modalAddName">Name</label>
                        <input type="text" name="name" class="form-control" id="modalAddName" placeholder="Name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="modalAddSubjectName">Subject Name</label>
                        <input type="text" name="subject_name" class="form-control" id="modalAddSubjectName" placeholder="Subject Name" value="{{ old('subject_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="modalAddMarks">Marks</label>
                        <input type="number" name="marks" class="form-control" id="modalAddMarks" placeholder="Marks" value="{{ old('marks') }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

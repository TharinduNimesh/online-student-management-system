@extends('layouts.student')

@section('title', 'Notes')

@section('section')
    {{-- Notes Start --}}
    <div class="row mt-3">
        <div class="col-12 p-3 bg-dark">
            <div class="row">
                <h3 class="text-light mx-3">Lesson Notes</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered-table-hover table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Lesson Note</th>
                            <th>Submited At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($notes) == 0)
                            <tr>
                                <td colspan="6" class="text-center">No Any Notes Found</td>
                            </tr>
                        @else
                            <tr>
                                @foreach ($notes as $key => $note)
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $note->title }}</td>
                                    <td>{{ $note->subject->name }}</td>
                                    <td>Grade - {{ $note->grade }}</td>
                                    <td>
                                        <a href="{{ asset('storage/notes/' . $note->file) }}" 
                                            class="btn btn-success">
                                            <i class="fas fa-download mx-2"></i>
                                            Download</a>
                                    </td>
                                    <td>{{ $note->uploaded_at }}</td>
                                @endforeach
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Notes End --}}
@endsection

@section('scripts')
    <script>
        updateActiveMenu('notes');
    </script>
@endsection

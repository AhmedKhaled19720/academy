<div class="col-md-10">
    <div class="card">
        <div class="card-header text-center tx-lg-20 bg-info">
            <h3 class="">Students for Assignment: {{ $assignment->ass_title }}</h3>
        </div>

        <div class="card-body">
            <div class="text-center">
                <h4>Course: {{ $course->course_title }}</h4>
            <h4>Assignment Degree: {{ $taskDegree }}</h4>
            </div>

        <div class="table-responsive table-center">
            <table class="table text-md-nowrap" id="example1">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student Email</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->username }}</td>
                            <td>{{ $student->email}}</td>
                            <td>
                                @if ($student->grades->isNotEmpty())
                                    {{ $student->grades->first()->grade }}
                                @else
                                    Not Added Yet!
                                @endif
                            </td>
                            <td>
                                @if ($student->grades->isNotEmpty())
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#editGradeModal{{ $student->id }}">Edit Grade</button>
                                @else
                                    Add grade First To Edit!
                                @endif
                            </td>
                        </tr>

                        @if ($student->grades->isNotEmpty())
                            <!-- Edit Grade Modal for each student -->
                            <div class="modal fade" id="editGradeModal{{ $student->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editGradeModalLabel{{ $student->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editGradeModalLabel{{ $student->id }}">Edit
                                                Grade for
                                                {{ $student->username }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit Grade Form -->
                                            <form method="POST"
                                                action="{{ route('grades.update', ['grade' => $student->grades->first()->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <h5>Assignment Degree: {{ $taskDegree }}</h5>
                                                    <label for="grade">Grade:</label>
                                                    <input type="number" class="form-control" id="grade"
                                                        name="grade" value="{{ $student->grades->first()->grade }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

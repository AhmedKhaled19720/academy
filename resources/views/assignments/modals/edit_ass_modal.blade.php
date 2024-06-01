<div class="modal fade" id="editAssignment{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="editAssignment{{ $assignment->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAssignment{{ $assignment->id }}Label">Edit Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('assignments.update', ['course_id' => $assignment->course_id, 'assignment_id' => $assignment->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="ass_title">Title</label>
                        <input type="text" class="form-control" id="ass_title" name="ass_title" value="{{ $assignment->ass_title }}">
                    </div>
                    <div class="form-group">
                        <label for="ass_description">Description</label>
                        <textarea class="form-control" id="ass_description" name="ass_description" rows="3">{{ $assignment->ass_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="ass_file">File</label>
                        <input type="text" class="form-control" id="ass_file" name="ass_file" value="{{ $assignment->ass_file }}" readonly>
                        <input type="file" class="form-control-file mt-2" id="ass_file" name="ass_file">
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $assignment->deadline }}">
                    </div>
                    <div class="form-group">
                        <label for="degree">Degree</label>
                        <input type="number" class="form-control" id="degree" name="degree" value="{{ $assignment->degree }}">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3">{{ $assignment->notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

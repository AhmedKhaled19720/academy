<div class="modal fade" id="editAssignment{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Edit Assignment</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('assignments.update', ['course_id' => $assignment->course_id, 'id' => $assignment->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label for="ass_title" class="col-sm-2 col-form-label text font-weight-bolder">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ass_title" id="ass_title" value="{{ $assignment->ass_title }}">
                        </div>
                    </div>
                    <input type="hidden" name="course_id" value="{{$assignment->course_id}}">
                    <div class="form-group row">
                        <label for="ass_description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="ass_description" id="ass_description" rows="6">{{ $assignment->ass_description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ass_file" class="col-sm-2 col-form-label form-label">File</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $assignment->ass_file }}" readonly>
                            <input type="file" class="form-control-file mt-2" name="ass_file" id="ass_file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deadline" class="col-sm-2 col-form-label form-label">Deadline</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="deadline" id="deadline" value="{{ $assignment->deadline }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="degree" class="col-sm-2 col-form-label form-label">Degree</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="degree" id="degree" value="{{ $assignment->degree }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="notes" class="col-sm-2 col-form-label form-label">Notes</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="notes" id="notes" rows="3">{{ $assignment->notes }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row modal-footer">
                        <div >
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
<!-- End Edit modal -->
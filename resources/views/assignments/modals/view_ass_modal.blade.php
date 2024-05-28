<div class="modal fade" id="showAssignment{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Assignment Details</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Title:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $assignment->ass_title }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="5" readonly>{{ $assignment->ass_description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">File:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $assignment->ass_file }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Deadline:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $assignment->deadline }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Degree:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $assignment->degree }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Notes:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $assignment->notes }}" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>

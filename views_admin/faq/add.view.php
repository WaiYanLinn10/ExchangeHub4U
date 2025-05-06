
<div class="modal fade" id="addFAQModal" tabindex="-1" aria-labelledby="addFAQModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/faq" method="POST" enctype="multipart/form-data">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="addFAQModalLabel">Add FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row px-0">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <input type="text" class="form-control" name="question" placeholder="Your question . . ." required>
                            </div>
                            <div class="mb-3">
                                <label for="answer" class="form-label">Answer</label>
                                <textarea name="answer" rows="4" class="form-control" placeholder="Your answer . . ."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Post as FAQ</label>
                                <select name="status" class="form-select" required>
                                    <option value="0">False</option>
                                    <option value="1">True</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success px-4">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
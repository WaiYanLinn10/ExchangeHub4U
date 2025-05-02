<div class="modal fade" id="answerFAQModal<?= $faq['faq_id']; ?>" tabindex="-1" aria-labelledby="answerFAQModal<?= $faq['faq_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/admin/faq?id=<?= $faq['faq_id']; ?>" method="POST">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $faq['faq_id']; ?>">
                
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="answerFAQModal<?= $faq['faq_id']; ?>Label">Answer FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row px-0">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="question" class="form-label">Question</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($faq['faq_question']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="answer" class="form-label">Answer</label>
                                    <textarea class="form-control" name="answer" rows="3"><?= htmlspecialchars($faq['faq_answer']); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

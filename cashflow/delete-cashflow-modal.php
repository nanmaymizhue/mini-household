<!-- Delete Cashflow Modal -->
<div class="modal fade" id="deleteCashFlow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Cashflow</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-warning">
                Are you sure you want to delete this cashflow?
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                <a class="btn btn-danger" href="delete-cashflow?id=<?= $row['id']; ?>">Yes</a>
            </div>
        </div>
    </div>
</div>
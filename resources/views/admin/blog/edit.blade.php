<div class="modal-content border-0">
    <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="exampleModalLabel">Edit Blog Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
    </div>

    <form class="tablelist-form" id="edit_category_form" action="{{ route('blog.category.update', $blogCategory->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="modal-body">
            <div class="row g-3">

                <div class="col-lg-6">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" id="category_name" name="name" class="form-control" value="{{ $blogCategory->name }}" placeholder="Category name">
                    <span class="error error_e_name text-danger"></span>
                </div>

                <div class="col-lg-6">
                    <label for="category_status" class="form-label">Status</label>
                    <select class="form-control" name="status" id="category_status">
                        <option selected>Status</option>
                        <option value="1" {{ $blogCategory->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $blogCategory->status == 0 ? 'selected' : '' }}>De-Active</option>
                    </select>
                    <span class="error error_e_status text-danger"></span>
                </div>

                <div class="row g-3">
                    <div class="col-lg-6">
                        <label for="category_image" class="form-label">Image</label>
                        <input required type="file" id="category_image" name="image" class="form-control">
                        <span class="error error_e_name text-danger"></span>
                    </div>
                </div>


            </div>
        </div>

        <div class="modal-footer" style="display: block;">
            <div class="hstack gap-2 justify-content-end">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update_button">Update Blog Category</button>
            </div>
        </div>
    </form>
</div>


<script>

    $(document).on('submit', '#edit_category_form', function(e) {
        e.preventDefault();

        $('.update_button').prop('type', 'button');

        var url = $(this).attr('action');

        $.ajax({
            url: url,
            type: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                toastr.success(data);
                $('#editCategoryModal').modal('hide');
                $('.update_button').prop('type', 'submit');
                $('.category_table').DataTable().ajax.reload();
            },
            error: function(err) {

                $('.error').html('');

                $('.submit_button').prop('type', 'submit');

                if (err.status == 0) {
                    toastr.error('Net Connetion Error. Reload This Page.');
                    return;
                } else if (err.status == 500) {
                    toastr.error('Server error. Please contact to the support team.');
                    return;
                }
                $.each(err.responseJSON.errors, function(key, error) {
                    $('.error_e_' + key + '').html(error[0]);
                });
            }
        });


    });
</script>


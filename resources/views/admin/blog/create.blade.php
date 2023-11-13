<div class="modal-content border-0">
    <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="exampleModalLabel">Add Blog</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
    </div>
    <form class="tablelist-form" autocomplete="off" id="add_category_form" action="{{ route('admin.blog.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-lg-6">
                    <label for="title" class="form-label">Blog Title</label>
                    <input  type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Blog Title">
                    <span class="error error_title text-danger"></span>
                </div>
                <!--end col-->
                <div class="col-lg-6">
                    <label for="category_status" class="form-label">Status</label>
                    <select  class="form-control" name="status" id="category_status">
                        <option selected>Status</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }} >Active</option>
                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }} >De-Active</option>
                    </select>
                    <span class="error error_status text-danger"></span>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-6">
                    <label for="category_id" class="form-label">Blog Category</label>
                    <select  class="form-control" name="category_id" id="category_id">
                        <option selected>Blog Category</option>
                        @foreach ($blogCategories as $blogCategory)
                            <option value="{{ $blogCategory->id }}">{{ $blogCategory->name }}</option>
                        @endforeach
                    </select>
                    <span class="error error_category_id text-danger"></span>
                </div>

                <div class="col-lg-6">
                    <label for="category_image" class="form-label">Image</label>
                    <input  type="file" id="image" name="image" class="form-control" value="{{ old('name') }}" placeholder="Category Image">
                    <span class="error error_image text-danger"></span>
                </div>
            </div>

            <div class="row g-3">

                <div class="col-lg-12">
                    <label for="desc" class="form-label">Description</label>
                    <textarea name="desc" id="" class="form-control summernote" rows="10"></textarea>
                    {{-- <input  type="text" id="desc" name="desc" class="form-control" value="{{ old('desc') }}" placeholder="Category Image"> --}}
                    <span class="error error_desc text-danger"></span>
                </div>

            </div>
        </div>
        <div class="modal-footer" style="display: block;">
            <div class="hstack gap-2 justify-content-end">
                <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success submit_button">Add Blog</button>
            </div>
        </div>
    </form>
</div>


<script>

    $(document).ready(function() {

        $('.summernote').summernote();

    });

    /**
     * Add Product Category
     * @author Nymul Islam Moon < towkir1997islam@gmail.com >
     * */
    $(document).on('submit', '#add_category_form', function(e) {
        e.preventDefault();

        // $('.loading_button').show();
        var url = $(this).attr('action');
        $('.submit_button').prop('type', 'button');

        $.ajax({
            url: url,
            type: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#add_category_form')[0].reset();

                $('#addCategoryModal').modal('hide');

                $('.submit_button').prop('type', 'submit');

                $('.category_table').DataTable().ajax.reload();

                toastr.success(data)

            },
            error: function(err) {
                let error = err.responseJSON;

                $('.submit_button').prop('type', 'submit');

                $.each(error.errors, function (key, error){

                    // $('.submit_button').prop('type', 'submit');
                    $('.error_' + key + '').html(error[0]);
                });
            }
        });
    });
</script>

<div class="modal-content border-0">
    <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
    </div>

    <form class="tablelist-form" id="edit_user_form" action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-lg-4">
                    <label for="first_name" class="form-label">First Name</label>
                    <input required type="text" id="first_name" name="first_name" class="form-control" value="{{ $user->first_name }}" placeholder="First Name">
                    <span class="error error_first_name text-danger"></span>
                </div>

                <div class="col-lg-4">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input required type="text" id="last_name" name="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Last Name">
                    <span class="error error_last_name text-danger"></span>
                </div>

                <div class="col-lg-4">
                    <label for="email" class="form-label">E-mail</label>
                    <input required type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="User email">
                    <span class="error error_email text-danger"></span>
                </div>

            </div>

            <div class="row g-3 mt-1">

                <div class="col-lg-4">
                    <label for="user_phone" class="form-label">Phone</label>
                    <input required type="text" id="user_phone" name="phone" class="form-control" value="{{ $user->phone }}" placeholder="User phone">
                    <span class="error error_phone text-danger"></span>
                </div>

                <!--end col-->
                <div class="col-lg-4">
                    <label for="is_admin" class="form-label">Is Admin</label>
                    <select required class="form-control" name="is_admin" id="is_admin">
                        <option selected>Select User type</option>
                        <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }} >Admin</option>
                        <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }} >User</option>
                    </select>
                    <span class="error error_is_admin text-danger"></span>
                </div>

                <!--end col-->
                <div class="col-lg-4">
                    <label for="user_status" class="form-label">Status</label>
                    <select required class="form-control" name="status" id="user_status">
                        <option selected>Select type</option>
                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }} >Active</option>
                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }} >Block</option>
                    </select>
                    <span class="error error_status text-danger"></span>
                </div>

            </div>
            <div class="row g-3 mt-1">

                <div class="col-lg-4">
                    <label for="user_image" class="form-label">Image</label>
                    <input type="file" id="user_image" name="image" class="form-control" placeholder="User Image">
                    <span class="error error_image text-danger"></span>
                </div>

                 <!--end col-->
                <div class="col-lg-4">
                    <label for="user_gender" class="form-label">Gender</label>
                    <select required class="form-control" name="gender" id="user_gender">
                        <option selected>Select Gender</option>
                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }} >Male</option>
                        <option value="2" {{ $user->gender == 2 ? 'selected' : '' }} >Female</option>
                    </select>
                    <span class="error error_gender text-danger"></span>
                </div>

                <div class="col-lg-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" name="address" class="form-control" value="{{ $user->address }}" placeholder="User Address">
                    <span class="error error_address text-danger"></span>
                </div>

            </div>
        </div>

        <div class="modal-footer" style="display: block;">
            <div class="hstack gap-2 justify-content-end">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update_button">Update User</button>
            </div>
        </div>
    </form>
</div>


<script>

    $(document).on('submit', '#edit_user_form', function(e) {
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


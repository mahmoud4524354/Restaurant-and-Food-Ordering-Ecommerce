<<!-- General JS Scripts -->
<script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
<script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/stisla.js') }}"></script>

<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom.js') }}"></script>
<script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{ $error }}")
    @endforeach
    @endif
</script>


<script>
    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        label_default: "Choose File", // Default: Choose File
        label_selected: "Change File", // Default: Change File
        no_label: false, // Default: false
        success_callback: null // Default: null
    });

    $(document).ready(function () {

        $('body').on('click', '.delete-item', function (e) {
            e.preventDefault()

            let url = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {_token: "{{ csrf_token() }}"},
                        success: function (response) {
                            if (response.status === 'success') {
                                toastr.success(response.message)

                                window.location.reload();

                            } else if (response.status === 'error') {
                                toastr.error(response.message)
                            }
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    })
                }
            })
        })

    })

</script>


@stack('scripts')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/overlayscrollbars.browser.es6.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>

{{-- Datatable --}}
<script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script>
	// let table = new DataTable('.table');
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ✅ Success alert
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        // ❌ Error alert
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                confirmButtonText: 'OK'
            });
        @endif

        // ⚠️ Validation errors
        @if ($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
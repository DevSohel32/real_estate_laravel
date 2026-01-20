
    <script src="{{ asset('dist-admin/js/scripts.js') }}"></script>
    <script src="{{ asset('dist-admin/js/custom.js') }}"></script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    message: '{{ $error }}',
                    position: 'topRight',
                    timeout: 5000,
                    progressBarColor: '#ff0000',
                    transitionIn: 'bounceInDown',
                    transitionOut: 'fadeOut',
                });
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            iziToast.success({
                message: '{{ session('success') }}',
                position: 'topRight'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            iziToast.error({
                message: '{{ session('error') }}',
                position: 'topRight'
            });
        </script>
    @endif
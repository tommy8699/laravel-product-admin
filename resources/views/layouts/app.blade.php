<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('messages.app') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-semibold" href="{{ url('/') }}">
            {{ __('messages.app') }}
        </a>

        <div class="ms-auto d-flex align-items-center gap-3">

            <div class="btn-group btn-group-sm"
                 role="group"
                 aria-label="Language">

                <a href="{{ route('locale', 'sk') }}"
                   class="btn {{ app()->getLocale() === 'sk' ? 'btn-light' : 'btn-outline-light' }}">
                    SK
                </a>

                <a href="{{ route('locale', 'en') }}"
                   class="btn {{ app()->getLocale() === 'en' ? 'btn-light' : 'btn-outline-light' }}">
                    EN
                </a>

            </div>

            @auth
                <form method="POST"
                      action="{{ route('logout') }}"
                      class="m-0">

                    @csrf

                    <button type="submit"
                            class="btn btn-outline-light btn-sm">
                        {{ __('messages.logout') }}
                    </button>

                </form>
            @endauth

        </div>
    </div>
</nav>


<main class="container py-4 py-md-5">
    @yield('content')
</main>

@if(session('success'))

    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3"
         style="z-index: 1100; margin-top: 70px;">

        <div id="successToast"
             class="toast text-bg-success border-0 shadow"
             role="alert"
             aria-live="assertive"
             aria-atomic="true"
             data-bs-autohide="true"
             data-bs-delay="4000">

            <div class="d-flex">

                <div class="toast-body">
                    {{ session('success') }}
                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"
                        aria-label="Close">
                </button>

            </div>

        </div>

    </div>

@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.getElementById('successToast');

            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement);
                toast.show();
            }
        });
    </script>
@endif

</body>
</html>
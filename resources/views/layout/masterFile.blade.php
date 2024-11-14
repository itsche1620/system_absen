@include('layout/header')
@include('layout/navbar')
@include('layout/sidebar')
    @yield('content');


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/multiple-input.js') }}"></script>
    @stack("script")
@include('layout/footer')

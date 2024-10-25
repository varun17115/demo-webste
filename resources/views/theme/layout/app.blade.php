<body id="body">
    @include('theme.partial.header')
    @include('admin.partial.style')
    <div class="layout-wrapper layout-content-navbar" style="background-color: #F5F5F9">
        <div class="layout-container">
        {{-- <nav class="sidebar sidebar-offcanvas" id="sidebar" > --}}
            @include('theme.partial.sidebar')
        {{-- </nav> --}}
        <div class="layout-page">
        {{-- <div style="background:#191c24;overflow:hidden" class="container-fluid page-body-wrapper"> --}}
            @include('theme.partial.navbar')
            @yield('content')
        </div>        
    @stack('script')
    @include('theme.partial.script')
    

</body>
<body id="body">
    @include('admin.partial.header')
    @include('admin.partial.style')
    <div class="layout-wrapper layout-content-navbar" style="background-color: #F5F5F9">
        <div class="layout-container">
            @include('admin.partial.sidebar')
            <div class="layout-page">
                @include('admin.partial.navbar')
                @yield('content')
            </div>
        </div>
    </div>
    @stack('script')
    @include('admin.partial.script')


</body>

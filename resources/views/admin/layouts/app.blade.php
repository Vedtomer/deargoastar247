<!DOCTYPE html>
<html  lang="en">
@include('admin.layouts.head')

<body class="layout-boxed" page="starter-pack">
    {{-- <div class="page-wrapper"> --}}

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    @include('admin.layouts.header')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>


        @include('admin.layouts.sidebar')
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>

                    </div>

                    <!-- /BREADCRUMB -->

                    <!-- CONTENT AREA -->
                    @yield('content')
                    <!-- CONTENT AREA -->
                </div>

            </div>
            @include('admin.layouts.footer')
        </div>
    </div>
    {{-- </div> --}}
    @include('admin.layouts.scripts')

    <!-- Add the robots meta tag to prevent indexing -->
    <meta name="robots" content="noindex, nofollow">

</body>

</html>

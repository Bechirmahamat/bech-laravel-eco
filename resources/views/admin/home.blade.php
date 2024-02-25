<!DOCTYPE html>
<html lang="en">

<head>
    {{-- css file --}}
    <base href="/public">
    @include('admin.css')
    {{-- css file --}}
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            @include('admin.body')
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    {{-- js file --}}
    @include('admin.script');
    {{-- js file --}}
</body>

</html>

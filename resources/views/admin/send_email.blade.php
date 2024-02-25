<!DOCTYPE html>
<html lang="en">

<head>
    {{-- css file --}}
    <base href="/public">

    @include('admin.css')
    {{-- css file --}}
    <style>
        @media(max-width:700px) {
            #product-form {
                width: 100% !important;
            }
        }

        input:focus {
            color: white !important;
        }

        table tr:nth-child(even) {
            background: #30263a;
        }

        table tr:nth-child(odd) {
            background: #1b1523
        }

        table thead tr {
            background: rgb(61, 53, 92) !important;
            color: white !important;
        }

        textarea {
            display: inline;
            width: 100%;
            height: 150px !important;
            background: #2A3038;
        }
    </style>
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
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss='alert' aria-hidden="true">x</button>
                        </div>
                    @endif()
                    <h2 class="text-light  text-center my-4">Send email to<span class="text-danger ">
                            {{ $orders->email }}</span> </h2>
                    <form id="product-form" class="w-50 mx-auto" action="{{ route('sendemail', $orders->id) }}"
                        method="post">

                        @csrf
                        <div class="form-group">
                            <label for="form-label"> Email Greeting:</label>
                            <input type="text" placeholder="Enter Email greeting" name="greeting"
                                class="form-control" value="{{ old('greeting') }}">
                            <x-input-error :messages="$errors->get('greeting')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Email first Line:</label>
                            <input type="text" placeholder="Enter firstline" name="firstline" class="form-control"
                                value="{{ old('firstline') }}">
                            <x-input-error :messages="$errors->get('firstline')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Email body:</label>
                            <input type="text" placeholder="Enter body" name="body" class="form-control"
                                value="{{ old('body') }}">
                            <x-input-error :messages="$errors->get('body')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Email Button Name :</label>
                            <input type="text" placeholder="Enter button" name="button" class="form-control"
                                value="{{ old('button') }}">
                            <x-input-error :messages="$errors->get('button')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Email url:</label>
                            <input type="text" placeholder="Enter url" name="url" class="form-control"
                                value="{{ old('url') }}">
                            <x-input-error :messages="$errors->get('url')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Email Last Line:</label>
                            <input type="text" placeholder="Enter url" name="lastline" class="form-control"
                                value="{{ old('lastline') }}">
                            <x-input-error :messages="$errors->get('lastline')" class="mt-1 text-danger" />
                        </div>

                        <div class="form-group ">
                            <button type='submit' value='add' value='1' class="btn btn-success w-100 py-3">Send
                                Email</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    {{-- js file --}}
    @include('admin.script')
    {{-- js file --}}
</body>

</html>

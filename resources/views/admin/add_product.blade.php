<!DOCTYPE html>
<html lang="en">

<head>
    {{-- css file --}}

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
                    <h2 class="text-light my-4">Add New <span class="text-danger">products</span> </h2>
                    <form id="product-form" class="w-50" action="{{ route('add_product') }}" method="post"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="form-label">Title:</label>
                            <input type="text" placeholder="Enter title" name="title" class="form-control"
                                value="{{ old('title') }}">
                            <x-input-error :messages="$errors->get('title')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Price:</label>
                            <input type="text" placeholder="Enter price" name="price" class="form-control"
                                value="{{ old('price') }}">
                            <x-input-error :messages="$errors->get('price')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Quantity:</label>
                            <input type="text" placeholder="Enter quantity" name="quantity" class="form-control"
                                value="{{ old('quantity') }}">
                            <x-input-error :messages="$errors->get('quantity')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Image:</label>
                            <input type="file" placeholder="Enter image" name="image" class="form-control"
                                value="{{ old('image') }}">
                            <x-input-error :messages="$errors->get('image')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="">Category:</label>
                            <select name="category" class="form-select text-light form-control" id="">
                                <option value="">select a category :</option>
                                @foreach ($category as $item)
                                    <option class="form-control py-1" value="{{ $item->category_name }}"
                                        {{ old('category') == $item->category_name ? 'selected' : '' }}>
                                        {{ $item->category_name }}</option>
                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Description:</label>
                            <textarea placeholder="Enter description" name="description" class="form-control text-light">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="form-label">Discount Price:</label>
                            <input type="text" placeholder="Enter discount price" name="discount_price"
                                value='0.00' class="form-control">
                            <x-input-error :messages="$errors->get('discount_price')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <button type='submit' value='add' value='1' class="btn btn-primary">Add
                                product</button>
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

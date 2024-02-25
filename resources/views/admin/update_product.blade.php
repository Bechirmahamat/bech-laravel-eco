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

        .content-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .go_back {
            text-align: left;
            justify-self: left;
            align-self: flex-start;
        }

        .flex-input {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 10px;
        }

        .flex-input .form-control {
            height: 60px !important;
        }

        .flex-input label {
            width: 100%;
        }
    </style>
    <!-- boostrap icons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->

            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">
                    <p class="alert alert-info"> You can only submit once is there is an error you must go back</p>
                    <a href="{{ route('show_product') }}"><button class="btn btn-danger go_back"><i
                                class="bi-arrow-left"></i> Go back</button></a>

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss='alert' aria-hidden="true">x</button>
                        </div>
                    @endif()
                    <h2 class="text-light my-4">Update <span class="text-danger">products</span> </h2>
                    <form id="product-form" class="w-50" action="{{ route('finish_update_product') }}" method="post"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{ old('id') }}">
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
                        <div class="form-group flex-input">
                            <div>
                                <label for="form-label">previous image:</label>
                                <input type="hidden" name="prev_image" value="{{ old('image') }}">
                                <?php if (old('prev_image')) {
                                    $image = old('image');
                                } else {
                                    $image = old('image');
                                } ?>
                                <img width="70px" height="60px" src="storage/{{ $image }}" alt="">
                            </div>

                            <div> <label for="form-label">Update image:</label>
                                <input type="file" placeholder="Enter image" name="image" class="form-control">
                                <x-input-error :messages="$errors->get('image')" class="mt-1 text-danger" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="">Category:</label>
                            <select name="category" class="form-select text-light form-control" id="">



                                <?php  if((old('categories'))){
                                    $variable=old('categories');
                                    
                                    
                                    foreach ($variable as $item) { ?>
                                <option class="form-control py-1" value="{{ $item->category_name }}"
                                    {{ old('category') == $item->category_name ? 'selected' : '' }}>
                                    {{ $item->category_name }}</option>

                                <?php }   } ?>

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
                                value='{{ old('discount_price') }}' class="form-control">
                            <x-input-error :messages="$errors->get('discount_price')" class="mt-1 text-danger" />
                        </div>
                        <div class="form-group">
                            <button type='submit' value='add' value='1' class="btn btn-danger">finish
                                update</button>
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

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    {{-- css file --}}
    @include('admin.css')
    {{-- css file --}}
    <style>
        table img {
            width: 100%;
            height: 100%;
            border-radius: 0px !important;
        }

        table tr {
            height: 50px;
            padding: 2px auto !important;
        }

        thead tr {
            background: rgb(8, 87, 107) !important;
            color: aliceblue !important;
        }

        thead tr th {

            color: aliceblue !important;
        }

        td {
            color: gainsboro;
        }

        table tr:nth-child(even) {
            background: rgb(62, 62, 77);
        }

        table tr:nth-child(odd) {
            background: rgb(45, 48, 46);
        }

        @media(max-width:700px) {
            .overflow {
                overflow-x: scroll;
            }

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
                        <div class="text-center text-capitalize alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @elseif(session()->has('delete'))
                        <div class="text-center text-capitalize alert alert-danger">
                            {{ session()->get('delete') }}
                        </div>
                    @endif
                    <h2 class="text-light text-center my-4">Show <span class="text-danger">products</span> </h2>

                    <div class="overflow">
                        <table class="table">
                            <thead>
                                <tr class="tr text-light">
                                    <th>Ids</th>
                                    <th>Images</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>category</th>
                                    <th>Discount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                    <tr class="tr">
                                        <td>{{ $product->id }}</td>
                                        <td><img src="storage/{{ $product->image }}" alt=""></td>
                                        <td>{{ $product->title }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>${{ $product->discount_price }}</td>
                                        <td>
                                            <a href="{{ url('update_product', $product->id) }}"> <button
                                                    class="btn btn-primary">edit</button></a>
                                            <a href="delete_product?id={{ $product->id }}"><button
                                                    class="btn btn-danger">delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
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

    <script>
        const alertElement = document.querySelector('.alert');
        const Element = document.querySelector('.content-wrapper');
        if (alertElement) {
            setTimeout(() => {
                alertElement.remove();
            }, 4000);
        }
    </script>
</body>

</html>

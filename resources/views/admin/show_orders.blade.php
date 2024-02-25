<!DOCTYPE html>
<html lang="en">

<head>
    {{-- css file --}}
    @include('admin.css')
    {{-- css file --}}
    <!-- boostrap icons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <style>
        /* table img{
        width: 100%;
        height: 100%;
        border-radius: 0px !important;
    } */
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

        .overflow {
            overflow-x: scroll;
        }

        .overflow::-webkit-scrollbar {
            width: 2px;
        }

        .overflow::-webkit-scrollbar-thumb {
            background-color: rgb(37, 36, 36);
            border-radius: 4px;
            width: 40px;
            height: 10px;
        }

        td {}

        tr .badge {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .badge {
            padding: 5px !important;
        }

        .overflow::-webkit-scrollbar-thumb:hover {
            background-color: gray;
        }


        @media(max-width:700px) {
            .overflow {
                overflow-x: scroll;
            }

            .form {
                width: 100% !important;

            }

            .input_style {
                display: grid;
                grid-template-columns: 1fr 0.5fr !important;
            }


        }

        .input_style {
            display: grid;
            grid-template-columns: 1fr 0.4fr;
            gap: 5px
        }

        .badge-danger {
            background: transparent;
            border: 1px solid red;
            color: red;
        }

        .badge-success {
            background: transparent;
            border: 1px solid greenyellow;
            color: greenyellow;
        }

        .badge-primary {
            background: transparent;
            border: 1px solid blue;
            color: blue;
        }

        .input_style input:focus {
            border: 2px solid darkblue;
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
                    <h2 class="text-center my-5">All <span class="text-danger">Orders</span> List</h2>

                    {{-- <div class="w-50 form text-light">
                        <form action="">
                            <div class="form-group input_style">
                                <input type="text" class="form-control text-light"
                                    placeholder="Search user name or email">
                                <button class="btn btn-outline-primary"><i class="bi-search"></i> search</button>
                            </div>
                        </form>
                    </div> --}}

                    <div class="overflow">
                        <table class="table">
                            <thead>
                                <tr class="tr text-light">
                                    <th>Ids</th>
                                    <th>user_id</th>
                                    <th>user_name</th>
                                    <th>Phone</th>
                                    <th>city</th>
                                    <th>Address</th>
                                    <th>price</th>
                                    <th>payment</th>
                                    <th>order_status</th>
                                    <th>date</th>
                                    <th>Action</th>
                                    <th>print pdf</th>
                                    <th>send email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="tr">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->city }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($order->address, 6) }}
                                        </td>
                                        <td>${{ $order->price }}</td>
                                        <td><span
                                                class="badge text-{{ $order->order_status == 'paid' ? 'success' : 'danger' }}">{{ $order->order_status }}</span>
                                        </td>
                                        <td class=""><span
                                                class="badge badge-{{ Illuminate\Support\Arr::random(['primary', 'success', 'danger']) }}">processing</span>
                                        </td>
                                        <td class="">{{ Illuminate\Support\Str::limit($order->created_at, 8) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary">edit</button>
                                            <a href=""><button class="btn btn-danger">delete</button></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('print_pdf', $order->id) }}"><button
                                                    class="btn btn-secondary">print</button></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('send_email', $order->id) }}"><button
                                                    class="btn btn-info">Email</button></a>
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
</body>

</html>

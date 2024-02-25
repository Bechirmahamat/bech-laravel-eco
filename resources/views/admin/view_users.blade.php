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
                    <h2 class="text-center my-5">All <span class="text-danger">Users</span> List</h2>

                    <div class="w-50 form text-light">
                        <form action="">
                            <div class="form-group input_style">
                                <input type="text" class="form-control text-light"
                                    placeholder="Search user name or email">
                                <button class="btn btn-outline-primary"><i class="bi-search"></i> search</button>
                            </div>
                        </form>
                    </div>

                    <div class="overflow">
                        <table class="table">
                            <thead>
                                <tr class="tr text-light">
                                    <th>Ids</th>
                                    {{-- <th>Images</th> --}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr class="tr">
                                        <td>{{ $user->id }}</td>
                                        {{-- <td><img src="storage/{{$user->image}}"  alt=""></td> --}}
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($user->address, 10) }}</td>
                                        <td>
                                            <button class="btn btn-primary">edit</button>
                                            <a href="delete_user/{{ $user->id }}"><button
                                                    class="btn btn-danger">delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>



                    </div>
                    <div class="pagination my-3">
                        <ul class="pagination">
                            <li class="page-item {{ $users->currentPage() === 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @if ($users->currentPage() > 3)
                                <li class="page-item"><a class="page-link" href="{{ $users->url(1) }}">1</a></li>
                                <li class="disabled"><span>&hellip;</span></li>
                            @endif
                            @foreach (range(1, $users->lastPage()) as $page)
                                @if ($page >= $users->currentPage() - 2 && $page <= $users->currentPage() + 2)
                                    <li class="page-item{{ $page === $users->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                            @if ($users->currentPage() < $users->lastPage() - 2)
                                <li class=" page-item disabled"><span>&hellip;</span></li>
                                <li><a class="page-link"
                                        href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a></li>
                            @endif
                            <li
                                class=" page-item {{ $users->currentPage() === $users->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
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

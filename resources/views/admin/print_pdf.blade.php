<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>order details</title>
    <style>
        table tr {
            height: 50px;
            padding: 2px auto !important;
        }

        thead tr {
            background: rgb(8, 87, 107) !important;
            color: aliceblue !important;

        }

        .name {
            font-weight: bold;
        }

        thead tr th {

            color: aliceblue !important;
            padding: 15px 5px !important;
        }

        td {
            color: black;
            padding: 15px 5px !important;

        }

        table tr:nth-child(even) {
            background: rgb(236, 236, 236);
        }


        .text-danger {
            color: rgb(206, 75, 75);
        }

        .d-flex {
            margin-left: auto;
            width: 50%;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <h2>Bech <span class="text-danger">delevery</span></h2>

    <p> <span class="name">Name: </span> <span>{{ $user->name }}</span> </p>
    <p> <span class="name">Email: </span> <span>{{ $user->email }}</span> </p>
    <p> <span class="name"> Address :</span> <span>{{ $user->address }}</span></p>

    <h4 class="text-primary">Orders details</h4>
    <table class="table">
        <thead>
            <tr class="tr">
                <th>Id</th>
                <th>image</th>
                <th>name</th>
                <th>price</th>
                <th></th>
                <th>quantity</th>
                <th>Date</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="tr">
                    <td>{{ $order->id }}</td>
                    <td> <img src="storage/{{ $order->image }}" height="50px" alt=""></td>
                    <td>{{ $order->title }}</td>
                    <td class="text-danger">${{ $order->price }}</td>
                    <td class="text-danger">*</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="w-50 ml-auto d-flex">
        <h4 class="name">Total price: ${{ $user->price }}</h4>
        <h4 class="name"></h4>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>

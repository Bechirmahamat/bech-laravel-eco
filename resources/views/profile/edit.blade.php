<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="row">
                <div class="col-lg-4">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h1 class="fs-3">Your <span class="text-danger mb-3">orders</span></h1>
                <hr class=" mb-3 "
                    style="
                width:50px;
                height:5px;
                display:inline-block;
                background:red;
                border:none;
                opacity:1;
                ">
                <table class="table">
                    <thead>
                        <tr class="tr bg-dark">
                            <th>image</th>
                            <th>price</th>
                            <th>status</th>
                            <th>date</th>
                            <th>details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr">
                            <td>
                                <img src="images/p5.png" alt="">
                            </td>
                            <td>$9.99</td>
                            <td>not paid</td>
                            <td>10/33/2023</td>
                            <td class="">
                                <button class="btn btn-success">Details</button>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>
                                <img src="images/p6.png" alt="">
                            </td>
                            <td>$9.99</td>
                            <td>not paid</td>
                            <td>10/33/2023</td>
                            <td class="">
                                <button class="btn btn-success">Details</button>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>
                                <img src="images/p8.png" alt="">
                            </td>
                            <td>$9.99</td>
                            <td>not paid</td>
                            <td>10/33/2023</td>
                            <td class="">
                                <button class="btn btn-success">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

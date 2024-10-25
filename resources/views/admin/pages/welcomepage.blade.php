@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row  ">
            <div class="  col-sm-4  mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-row">
                            <div class=" d-flex align-items-center">
                                <span style="font-size:40px;line-height:1"
                                    class="mdi mdi-truck-delivery-outline d-inline-block"></span>
                            </div>
                            <div class=" d-flex flex-column text-end     ">
                                <span class="fs-5">{{ $total['total_order'] }}</span>
                                <span class="">Orders</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  col-sm-4  mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-row">
                            <div class=" d-flex align-items-center">
                                <span style="font-size:40px;line-height:1"
                                    class="mdi mdi-store-outline d-inline-block"></span>
                            </div>
                            <div class=" d-flex flex-column text-end">
                                <span class="fs-5">{{ $total['total_product'] }}</span>
                                <span class="">Products</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  col-sm-4  mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-row">
                            <div class=" d-flex align-items-center ">
                                <span style="font-size:40px;line-height:1"
                                    class="mdi mdi-basket-outline d-inline-block"></span>

                            </div>
                            <div class=" d-flex flex-column text-end">
                                <span class="fs-5">{{ $total['total_category'] }}</span>
                                <span class="">Categories</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="  col-sm-4 mb-4  ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-row">
                            <div class=" d-flex align-items-center">
                                <span style="font-size:40px;line-height:1"
                                    class="mdi mdi-shopping-outline d-inline-block"></span>

                            </div>
                            <div class=" d-flex flex-column text-end">
                                <span class="fs-5">{{ $total['total_brand'] }}</span>
                                <span class="">Brands</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  col-sm-4  mb-4 ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-row">
                            <div class=" d-flex align-items-center">
                                <span style="font-size:40px;line-height:1"
                                    class="mdi mdi-account-group d-inline-block"></span>

                            </div>
                            <div class=" d-flex flex-column text-end">
                                <span class="fs-5">{{ $total['total_user'] }}</span>
                                <span class="">Users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  col-sm-4 mb-4  ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-row">
                            <div class=" d-flex align-items-center">
                                <span style="font-size:40px;line-height:1"
                                    class="mdi mdi-comment-account-outline d-inline-block"></span>
                            </div>
                            <div class=" d-flex flex-column text-end">
                                <span class="fs-5">{{ $total['total_feedback'] }}</span>
                                <span class="">Feedbacks</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class=" col-md-6 mb-4">
                <div class="card chart-card h-100">
                    <div class="card-body  h-100">
                        <div class="card-title text-black">Orders Overview</div>
                        <div class="chart-wrapper text-black h-100">
                            <canvas class="text-black" id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-6 mb-4">
                <div class="card ">
                    <div class="card-body p-0">
                        <div class="card-title mb-0 text-black p-3">Recent Orders</div>
                        <div class="card-body pt-0">
                            <div class=" table-responsive">
                                <table class="table text-center table-stripped table-hover">
                                    <thead class="text-black">
                                        <tr>
                                            <th class="text-dark">Order</th>
                                            <th>Total Products</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_orders as $order)
                                            <tr>
                                                <td class="text-start">
                                                    <span class="text-dark">#{{ $order->order_id }}</span>
                                                    <span>{{ $order->user_detail->firstname }}
                                                        {{ $order->user_detail->lastname }}
                                                    </span>
                                                </td>
                                                <td class="text-black">
                                                    {{ $order->Total_Products }}
                                                </td>
                                                <td class="text-black">
                                                    {{ $order->Total_Price }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#dashboard_nav').addClass('active')
            var labels = {{ Js::from($labels) }};
            var users = {{ $data }};

            var ctx = document.getElementById('myChart').getContext('2d');

            new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [{
                        data: users,
                        borderColor: "#1338BE",
                        fillColor: "#1338BE",
                        backgroundColor: [
                            "rgba(19, 56, 193, 0.6)"
                        ],
                    }]
                },
                options: {

                    responsive: true,
                    aspectRatio: ($(".chart-card")[0].clientWidth / $(".chart-card")[0].clientHeight),
                    // maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scaleFontColor: "red "
                }
            });
        });
    </script>
@endpush

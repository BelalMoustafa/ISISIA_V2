@extends('admin.layout.app')

@section('style')
<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
    }
    .card h3 {
        margin: 0;
    }
    .card .icon {
        font-size: 2em;
        margin-bottom: 10px;
    }
    .card .count {
        font-size: 1.5em;
        font-weight: bold;
    }
    .bg-success{
        background-color: #897562 !important;
    }
    .bg-info{
        background-color: #b2927b !important;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ISISIA Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                                <div class="col-lg-4 col-12">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h3 class="count">{{ $shippedOrdersCount }}</h3>
                            <h4>Shipped Orders</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <h3 class="count">{{ $productCount }}</h3>
                            <h4>Total Products</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h3 class="count">{{ $categoryCount }}</h3>
                            <h4>Total Categories</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Quantities</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="productQuantityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ url('assets/dist/js/pages/dashboard3.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const productQuantities = {!! json_encode($productQuantities) !!};
    const productNames = productQuantities.map(item => item.product_name);
    const quantities = productQuantities.map(item => item.total_quantity);
    const maxQuantity = Math.max(...quantities);
    const maxY = maxQuantity + 3;

    const ctx = document.getElementById('productQuantityChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: 'Quantity',
                data: quantities,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                        }
                    },
                    max: maxY
                }
            }
        }
    });
</script>
@endsection

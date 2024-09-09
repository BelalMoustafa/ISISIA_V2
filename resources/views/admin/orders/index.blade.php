@extends('admin.layout.app')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.layout.message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders List</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <form action="{{ route('orders.index') }}" method="GET">
                            <div class="form-group">
                                <label for="status-filter">Filter by Status</label>
                                <select id="status-filter" name="status" class="form-control"
                                    onchange="this.form.submit()">
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>
                                        Accepted</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                    <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Waiting
                                    </option>
                                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders List</h3>
                            </div>
                            <div class="card-body p-0">
                                @if ($orders->isEmpty())
                                    <div class="alert alert-primary" role="alert"
                                        style="text-align: center; padding: 20px;">
                                        No Orders available
                                    </div>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Total Price</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Items</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->user->name }}</td>
                                                    <td>{{ $order->total_price }}</td>
                                                    <td>{{ ucfirst($order->status) }}</td>
                                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($order->orderItems as $item)
                                                                <li>{{ $item->product->title }} (x{{ $item->quantity }})
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @if ($order->status != 'rejected' && $order->status != 'shipped')
                                                            <form
                                                                action="{{ url('admin/orders/update-status/' . $order->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <select name="status" class="form-control"
                                                                    onchange="this.form.submit()">
                                                                    @if ($order->status == 'waiting')
                                                                        <option value="">Select Status</option>
                                                                        <option value="accepted"
                                                                            {{ $order->status == 'accepted' ? 'selected' : '' }}>
                                                                            Accept</option>
                                                                    @elseif($order->status == 'accepted')
                                                                        <option value="">Select Status</option>
                                                                        <option value="shipped"
                                                                            {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                                            shipped</option>
                                                                    @else
                                                                        <option value="">Select Status</option>
                                                                        <option value="accepted"
                                                                            {{ $order->status == 'accepted' ? 'selected' : '' }}>
                                                                            Accepted</option>
                                                                        <option value="rejected"
                                                                            {{ $order->status == 'rejected' ? 'selected' : '' }}>
                                                                            Rejected</option>
                                                                        <option value="waiting"
                                                                            {{ $order->status == 'waiting' ? 'selected' : '' }}>
                                                                            Waiting</option>
                                                                    @endif
                                                                </select>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div style="float:right">
                                        {!! $orders->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
@endsection

<!-- 
<div class="modal fade" id="requestPurchaseModal" tabindex="-1" aria-labelledby="requestPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestPurchaseModalLabel">Request Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="purchaseTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    
                            @foreach ($selling as $sell)
                                @if ($sell->status == 'pending')
                                    <tr>
                                        <td>{{ $sell->id }}</td>
                                        <td>{{ $sell->product_name }}</td>
                                        <td>{{ $sell->category_name }}</td>
                                        <td>{{ $sell->customer_name }}</td>
                                        <td>{{ $sell->quantity }}</td>
                                        <td>{{ $sell->date }}</td>
                                        <td>{{ $sell->status }}</td>
                                        <td>
                                            @if ($sell->status != 'approved')
                                                <form action="{{ route('products.approvePurchase', $sell->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                            @else
                                                <span class="badge bg-success">Approved</span>
                                            @endif
                                            <button type="button" class="btn btn-danger" onclick="handlePurchase({{ $sell->id }})"><i class="fas fa-wrong"></i> Approve</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
              
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->
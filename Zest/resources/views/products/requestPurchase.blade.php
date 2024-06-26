<!-- Request Purchase Modal -->
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
                            <th scope="col">Category</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Supplier Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    
                            @foreach ($purchase as $pur)
                                @if ($pur->status == 'pending')
                                    <tr>
                                    <td>{{ $pur->id }}</td>
                                        <td>{{ $pur->category }}</td> <!-- Tambahkan ini -->
                                        <td>{{ $pur->product_name }}</td>
                                        <td>{{ $pur->supplier_name }}</td>
                                        <td>{{ $pur->quantity }}</td>
                                        <td>{{ $pur->in_date }}</td>
                                        <td>{{ $pur->status === 'approved' ? 'Approved' : 'Pending' }}</td>
                                        <td>
                                            @if ($pur->status != 'approved')
                                                <form action="{{ route('products.approvePurchase', $pur->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>

                                                <form action="{{ route('products.declinePurchase', $pur->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Decline</button>
                                                </form>
                                            @else
                                                <span class="badge bg-success">Approved</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
              
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
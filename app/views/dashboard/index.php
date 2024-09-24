<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/lib/dataTables/datatables.min.css"/>
    <link rel="stylesheet" href="/assets/lib/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="/assets/css/style.css"/>
    <title>CRUD - MVC</title>
</head>

<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark p-4" style="width: 250px; height: 100vh">
        <h4 class="text-white">Sidebar Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="/">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Settings</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="container-fluid p-4">
        <h1>Order Management</h1>

        <!-- Table -->
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>id</th>
                <th>User-Name</th>
                <th>Ordered-At</th>
                <th>Product-Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($data['orders'])): ?>
                <?php foreach ($data['orders'] as $order): ?>
                    <tr>
                        <td><?= $order['id']?></td>
                        <td><?= $order['username']?></td>
                        <td><?= $order['ordered_at']?></td>
                        <td><?= $order['product_name']?></td>
                        <td>
                            <select class="form-control status-select" name="status" data-order-id="<?= $order['id'] ?>">
                                <option disabled selected>Choose status...</option>
                                <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Approved" <?= $order['status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="Delivered" <?= $order['status'] === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                            </select>
                        </td>
                        <td>
                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm delete-btn" data-order-id="<?= $order['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this order?
                <input type="hidden" id="deleteOrderId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/assets/lib/dataTables/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {

        // Delete button click handler
        $(document).on('click', '.delete-btn', function() {
            var orderId = $(this).data('order-id');
            $('#deleteOrderId').val(orderId);
            $('#deleteModal').modal('show');
        });

        // Confirm delete handler
        $('#confirmDelete').on('click', function() {
            var orderId = $('#deleteOrderId').val();

            $.ajax({
                url: '/order/delete',
                method: 'POST',
                data: {
                    id: orderId
                },
                success: function(response) {
                    alert('Order deleted successfully!');
                    $('#deleteModal').modal('hide');
                    location.reload(); // Reload the page to reflect changes
                },
                error: function(xhr, status, error) {
                    alert('Error deleting order: ' + error);
                }
            });
        });

        // Status select change handler (can still be used outside the modal)
        $(document).on('change', '.status-select', function() {
            var orderId = $(this).data('order-id');
            var newStatus = $(this).val();

            $.ajax({
                url: '/order/status/update',
                method: 'POST',
                data: {
                    id: orderId,
                    status: newStatus
                },
                success: function(response) {
                    alert('Order status updated successfully!');
                },
                error: function(xhr, status, error) {
                    alert('Error updating order status: ' + error);
                }
            });
        });
    });
</script>
</body>

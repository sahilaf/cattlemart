<div class="order-container">
    <center class="order-header">
        <h2>My Order</h2>
    </center>
    <hr class="order-divider">
    <div class="order-table-responsive">
        <table class="order-table">
            <thead>
                <tr>
                    <th class="table-header">Sr.No</th>
                    <th class="table-header">Due Amount</th>
                    <th class="table-header">Invoice Number</th>
                    <th class="table-header">Order Date</th>
                    <th class="table-header">Paid/Unpaid</th>
                    <th class="table-header">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $customer_session = $_SESSION['customer_email'];

                // Get customer ID based on session email
                $get_customer = "SELECT customer_id FROM customers WHERE customer_email='$customer_session'";
                $run_cust = mysqli_query($con, $get_customer);
                $row_cust = mysqli_fetch_array($run_cust);
                $customer_id = $row_cust['customer_id'];

                // Query to get only pending (unpaid) orders for the logged-in customer
                $get_order = "
                    SELECT * FROM customer_order 
                    WHERE customer_id='$customer_id' 
                    AND order_status='pending'
                ";
                $run_order = mysqli_query($con, $get_order);
                $i = 0;

                while ($row_order = mysqli_fetch_array($run_order)) {
                    $order_id = $row_order['order_id'];
                    $order_due_amount = $row_order['due_amount'];
                    $order_invoice = $row_order['invoice_no'];
                    $order_date = substr($row_order['order_date'], 0, 11);
                    $order_status = $row_order['order_status'];
                    $i++;

                    // If the order status is pending, it's unpaid
                    if ($order_status == 'pending') {
                        $order_status = 'Unpaid';
                    } else {
                        $order_status = 'Paid';
                    }
                ?>
                    <tr class="table-row">
                        <td class="table-data"><?php echo $i; ?></td>
                        <td class="table-data"><?php echo $order_due_amount; ?></td>
                        <td class="table-data"><?php echo $order_invoice; ?></td>
                        <td class="table-data"><?php echo $order_date; ?></td>
                        <td class="table-data"><?php echo $order_status; ?></td>
                        <td class="table-data"><a href="confirm.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary btn-sm">Pay</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

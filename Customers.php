<?php include 'header.php'; ?>
    <?php include 'sidenav.php'; ?>
    <div class="container" style="width: 90%">
        <div class="row">
            <div class="col s12">
                <h2>
                    Customers
                    <a href="add-customer" class="btn-floating btn-medium waves-effect waves-light orange"><i class="material-icons">add</i></a>
                </h2>
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $customers = mysqli_query($con, "SELECT * FROM customers WHERE 1 ") ?>
                        <?php while ($customer = mysqli_fetch_assoc($customers)) : ?>
                            <tr>
                                <td><?php echo $customer['id'] ?></td>
                                <td><?php echo $customer['first_name'] ?></td>
                                <td><?php echo $customer['last_name'] ?></td>
                                <td><?php echo $customer['phone'] ?></td>
                                <td><?php echo $customer['email'] ?></td>
                                <td>
                                    <a href="edit-customer?id=<?php echo $customer['id'] ?>" data-id="<?php echo $customer['id'] ?>" class="btn-floating btn-small waves-effect waves-light cyan"><i class="material-icons">edit</i></a>
                                    <a href="delete-customer" data-id="<?php echo $customer['id'] ?>" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

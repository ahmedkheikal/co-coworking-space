<?php include 'header.php'; ?>
    <?php include 'sidenav.php'; ?>
    <div class="container" style="width: 90%">
        <div class="row">
            <div class="col s12">
                <h2>
                    Pricing
                </h2>
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $pricing_rules = mysqli_query($con, "SELECT pricing.*, rooms.name AS roomName FROM pricing
                            INNER JOIN rooms ON rooms.id = pricing.room_id
                            ") ?>
                        <?php while ($pricing = mysqli_fetch_assoc($pricing_rules)) : ?>
                            <tr>
                                <td><?php echo $pricing['roomName'] ?></td>
                                <td><?php echo $pricing['amount'] ?></td>
                                <td><?php echo $pricing['type'] ?></td>
                                <td>
                                    <a href="edit-pricing?room_id=<?php echo $pricing['room_id'] ?>" data-id="<?php echo $pricing['id'] ?>" class="btn-floating btn-small waves-effect waves-light cyan"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

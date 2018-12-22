<?php include 'header.php'; ?>
    <?php include 'sidenav.php'; ?>
    <div class="container" style="width: 90%">
        <div class="row">
            <div class="col s12">
                <h2>
                    All rooms
                    <a href="add-room" class="btn-floating btn-medium waves-effect waves-light orange"><i class="material-icons">add</i></a>
                </h2>
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>description</th>
                            <th>capacity</th>
                            <th>type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $rooms = mysqli_query($con, "SELECT * FROM rooms ") ?>
                        <?php while ($room = mysqli_fetch_assoc($rooms)) : ?>
                            <tr>
                                <td><?php echo $room['id'] ?></td>
                                <td><?php echo $room['name'] ?></td>
                                <td><?php echo $room['description'] ?></td>
                                <td><?php echo $room['capacity'] ?></td>
                                <td><?php echo $room['type'] ?></td>
                                <td>
                                    <a href="edit-room?id=<?php echo $room['id'] ?>" data-id="<?php echo $room['id'] ?>" class="btn-floating btn-small waves-effect waves-light cyan"><i class="material-icons">edit</i></a>
                                    <a href="delete-room" data-id="<?php echo $room['id'] ?>" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

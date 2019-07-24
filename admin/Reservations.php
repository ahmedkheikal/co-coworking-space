<?php include 'header.php'; ?>
    <?php include 'sidenav.php'; ?>
    <div class="container" style="width: 90%">
        <div class="row">
            <div class="col s12">
                <h2>
                    All Reservations
                    <a href="add-reservation" class="btn-floating btn-medium waves-effect waves-light orange"><i class="material-icons">add</i></a>
                </h2>
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Reservation Type</th>
                            <th>Client Name</th>
                            <th>Client Phone</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $reservations = mysqli_query($con, "SELECT rooms.name AS roomName, reservations.type, reservations.seat_number, customers.first_name AS customerFirst, customers.last_name AS customerLast, customers.phone AS customerPhone,
                            reservations.start, reservations.end, reservations.description, reservations.price, reservations.id
                            FROM reservations
                            LEFT OUTER JOIN customers ON customers.id = reservations.user_id
                            LEFT OUTER JOIN rooms ON rooms.id = reservations.room_id
                            WHERE 1
                            ORDER BY start ASC
                            ") ?>
                        <?php while ($reservation = mysqli_fetch_assoc($reservations)) : ?>
                            <tr>
                                <td><?php echo $reservation['roomName'] ?></td>
                                <td>
                                    <?php echo $reservation['type'] ?>
                                    <?php if ($reservation['type'] == 'individual'): ?>
                                        Seat Number: <?php echo $reservation['seat_number'] ?>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $reservation['customerFirst'] . ' ' . $reservation['customerLast'] ?></td>
                                <td><?php echo $reservation['customerPhone'] ?></td>
                                <td>
                                    <?php $start = new DateTime($reservation['start']) ?>
                                    <?php echo $start->format('d M Y') ?> <br>
                                    <strong><?php echo $start->format('h:i A') ?></strong>
                                </td>
                                <td>
                                    <?php $end = new DateTime($reservation['end']) ?>
                                    <?php echo $end->format('d M Y') ?> <br>
                                    <strong><?php echo $end->format('h:i A') ?></strong>
                                </td>
                                <td><?php echo $reservation['description'] ?></td>
                                <td><?php echo $reservation['price'] ?></td>
                                <td>
                                    <a href="edit-reservation?id=<?php echo $reservation['id'] ?>" data-id="<?php echo $reservation['id'] ?>" class="btn-floating btn-small waves-effect waves-light cyan"><i class="material-icons">edit</i></a>
                                    <a href="delete-record" data-id="<?php echo $reservation['id'] ?>" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
$('a[href=delete-record]').click(function (e) {
    e.preventDefault();
    var conf = confirm('Are you sure that you want to delete this record? ');
    if (conf)
    $.ajax({
        method: 'POST',
        url: 'api/delete-record',
        data: {
            table: 'reservations',
            id: $(this).attr('data-id')
        },
        success: function (data) {
            if (data.code == '200') {
                M.toast({html: data.response})
                setTimeout(function () {
                    location.reload();
                }, 1000)
            } else {
                M.toast({html: data.response})
            }
        }
    })
})

</script>

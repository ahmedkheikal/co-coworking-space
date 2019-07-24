<?php include 'header.php'; ?>
    <?php include 'sidenav.php'; ?>
    <div class="container" style="width: 90%">
        <div class="row">
            <div class="col s12">
                <h2>Reservations in the next 24 hours</h2>
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Reservation Type</th>
                            <th>Client Name</th>
                            <th>Client Phone</th>
                            <th>Start</th>
                            <th>End</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $reservations = mysqli_query($con, "SELECT rooms.name AS roomName, reservations.type, reservations.seat_number, customers.first_name AS customerFirst, customers.last_name AS customerLast, customers.phone AS customerPhone, reservations.start, reservations.end
                            FROM reservations
                            LEFT OUTER JOIN customers ON customers.id = reservations.user_id
                            LEFT OUTER JOIN rooms ON rooms.id = reservations.room_id
                            WHERE reservations.start > CURRENT_TIMESTAMP()
                            AND reservations.start < CURRENT_TIMESTAMP() + INTERVAL 24 HOUR") ?>
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
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

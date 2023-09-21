<?php

require_once 'classes/Reservation.php';

?>

<table class="table table-striped">

    <thead>
        <tr>
            <th scope="col">Voir</th>
            <th scope="col">Livre</th>
            <th scope="col">Client</th>
            <th scope="col">Début</th>
            <th scope="col">Fin</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach (Reservation::getCurrentReservation() as $item) : ?>
            <tr>
                <td><a href="/reservation.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-outline-light"><?= $item['id'] ?></a></td>
                <td><?= $item['title'] ?></td>
                <td><?= $item['firstname'] ?> - <?= $item['lastname'] ?></td>
                <td><?= (DateTime::createFromFormat('Y-m-d', $item['date_start']))->format('d/m/Y'); ?></td>
                <td><?= (DateTime::createFromFormat('Y-m-d', $item['date_end']))->format('d/m/Y'); ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>
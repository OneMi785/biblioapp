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
            <th scope="col">Date de retour</th>
            <th scope="col">Clôturé</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach (Reservation::getAllReservations() as $item) : ?>
            <tr>
                <td><a href="/reservation.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-outline-light"><?= $item['id'] ?></a></td>
                <td><?= $item['title'] ?></td>
                <td><?= $item['firstname'] ?> - <?= $item['lastname'] ?></td>
                <td><?= (DateTime::createFromFormat('Y-m-d', $item['date_start']))->format('d/m/Y'); ?></td>
                <td><?= (DateTime::createFromFormat('Y-m-d', $item['date_end']))->format('d/m/Y'); ?></td>
                <td><?= !empty($item['date_return']) ? (DateTime::createFromFormat('Y-m-d', $item['date_return']))->format('d/m/Y') : ""; ?></td>
                <td><?= $item['isClosed'] ? 1 : 0 ?></td>
                <td>
                    <?php if (!$item['isClosed']) : ?>
                        <a href="/reservations.php?idResa=<?= $item['id']; ?>" class="btn btn-sm btn-warning">Rendre</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>
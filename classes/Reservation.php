<?php

class Reservation
{
    private ?int $id;
    private ?int $book_id;
    private ?int $client_id;
    private ?string $date_start;
    private ?string $date_end;
    private ?string $date_return;
    private ?bool $isClosed;
    private ?bool $isArchived;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id)
    {
        $this->book_id = $book_id;
        return $this;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
        return $this;
    }

    public function getDateStart()
    {
        return $this->date_start;
    }

    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
        return $this;
    }

    public function getDateEnd()
    {
        return $this->date_end;
    }

    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
        return $this;
    }

    public function getDateReturn()
    {
        return $this->date_return;
    }

    public function setDateReturn($date_return)
    {
        $this->date_return = $date_return;
        return $this;
    }

    public function getIsClosed()
    {
        return $this->isClosed;
    }

    public function setIsClosed($isClosed)
    {
        $this->isClosed = $isClosed;
        return $this;
    }

    public function getIsArchived()
    {
        return $this->isArchived;
    }

    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;
        return $this;
    }

    public static function getCurrentReservation(): array
    {
        $sql = "SELECT cbr.*, c.firstname, c.lastname, b.title, b.author FROM clients_books_reservations AS cbr
        LEFT JOIN clients AS c ON cbr.client_id = c.id
        LEFT JOIN book AS b ON cbr.book_id = b.id
        WHERE cbr.isClosed = 0 AND cbr.isArchived = 0
        ORDER BY cbr.date_start ;
        LIMIT 20;";

        $db = Connect::connect();
        $query = $db->prepare($sql);
        $query->execute();
        $reservations = $query->fetchAll(
            PDO::FETCH_ASSOC,
        );

        return $reservations;
    }

    public static function getAllReservations(): array
    {
        $sql = "SELECT cbr.*, c.firstname, c.lastname, b.title, b.author FROM clients_books_reservations AS cbr
        LEFT JOIN clients AS c ON cbr.client_id = c.id
        LEFT JOIN book AS b ON cbr.book_id = b.id
        ORDER BY cbr.isArchived, cbr.isClosed, cbr.date_start;";

        $db = Connect::connect();
        $query = $db->prepare($sql);
        $query->execute();
        $reservations = $query->fetchAll(
            PDO::FETCH_ASSOC,
        );

        return $reservations;
    }

    public static function closeReservation($id): void
    {
        $sql = "UPDATE clients_books_reservations SET isClosed= 1, date_return = :dateRetour WHERE id = :id;";
        $dateRetour = (new DateTime('now'))->format('Y-m-d');

        $db = Connect::connect();
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateRetour', $dateRetour, PDO::PARAM_STR);
        $query->execute();
    }

    public static function addReservation($obj): void
    {
        $sql = "INSERT INTO clients_books_reservations (book_id, client_id, date_start, date_end, date_return, isClosed, isArchived) 
        VALUES (:book_id, :client_id, :date_start, :date_end, :date_return, :isClosed, :isArchived)";
        $db = Connect::connect();

        $dateStart = (new DateTime('now'))->format('Y-m-d');

        $query = $db->prepare($sql);
        $query->bindValue(':book_id', $obj->getBookId(), PDO::PARAM_INT);
        $query->bindValue(':client_id', $obj->getClientId(), PDO::PARAM_INT);
        $query->bindValue(':date_start', $dateStart, PDO::PARAM_STR);
        $query->bindValue(':date_end', $obj->getDateEnd(), PDO::PARAM_STR);
        $query->bindValue(':date_return', null, PDO::PARAM_STR);
        $query->bindValue(':isClosed', false, PDO::PARAM_BOOL);
        $query->bindValue(':isArchived', false, PDO::PARAM_BOOL);
        $query->execute();
        if ($query) {
            header('Location: reservations.php?success=1');
        } else {
            header('Location: reservations.php?success=0');
        }
    }
}
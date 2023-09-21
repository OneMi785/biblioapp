<?php

require 'classes/Book.php';
require 'templates/header.html.php';

/**
 * Page d'un livre seul
 */

$book = Book::getOneBook($_GET['slug']);

if (isset($_POST['id'])) {
    if (isset($_POST['delete'])){
        Book::deleteBook($_POST['id']);
    } else if (isset($_POST['edit'])){
        $book = new Book();
        $book->setId($_POST['id'])
            ->setTitle($_POST['title'])
            ->setAuthor($_POST['author'])
            ->setCategory($_POST['category'])
            ->setYear($_POST['year'])
            ->setIsbn($_POST['isbn'])
            ->setSlug($_POST['title']);
        Book::editBook($book, $_POST['id']);
    }
}

?>

<h1 class="text-center"><?= $book['title']; ?></h1>
<div class="justify-content-center d-flex gap-3">
    <button type="button" class="btn btn-outline-dark text-center" data-bs-toggle="modal" data-bs-target="#editBook">
        Modifier
    </button>
    <form method="post">
        <input name="id" type="number" value="<?= $book['id']; ?>" hidden>
        <input name="delete" type="submit" class="btn btn-danger" value="Supprimer">
    </form>
</div>

<!-- Modal, TODO: Sécuriser le formulaire et ses données-->
<div class="modal fade" id="editBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modification de <?= $book['title']; ?>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input name="id" type="number" value="<?= $book['id']; ?>" hidden>
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            Titre du livre
                        </label>
                        <input required name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp" value="<?= $book['title']; ?>">
                        <div id="titleHelp" class="form-text">
                            Saisissez le titre du livre.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">
                            Auteur du livre
                        </label>
                        <input required name="author" type="text" class="form-control" id="author" aria-describedby="authorHelp" value="<?= $book['author']; ?>">
                        <div id="authorHelp" class="form-text">
                            Saisissez le nom de l'auteur du livre.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            Choisissez une catégorie
                        </label>
                        <input name="category" list="listCategory" class="form-control" id="category" value="<?= $book['category']; ?>">
                        <datalist id="listCategory">
                            <option value="roman">Roman</option>
                            <option value="théâtre">Théâtre</option>
                            <option value="biographie">Biographie</option>
                            <option value="poésie">Poésie</option>
                            <option value="essai">Essai</option>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">
                            Quelle est l'année de l'édition
                        </label>
                        <input required name="year" type="text" class="form-control" id="year" aria-describedby="yearHelp" value="<?= $book['year']; ?>">
                        <div id="yearHelp" class="form-text">
                            Saisissez l'année au format "1980"
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">
                            Fournissez l'ISBN du livre
                        </label>
                        <input required name="isbn" type="text" class="form-control" id="isbn" aria-describedby="isbnHelp" value="<?= $book['isbn']; ?>">
                        <div id="isbnHelp" class="form-text">
                            Format attendu : "978-2-1234-5680-3"
                        </div>
                    </div>

                    <button name="edit" type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i>
                        Enregistrer
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

<?php

require 'templates/footer.html.php';
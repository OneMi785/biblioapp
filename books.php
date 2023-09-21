<?php

require 'classes/Book.php';

$totalBooks = count(Book::getBooks());

// Traitement du formulaire
if (!empty($_POST)) {
    $book = new Book();
    $book->setTitle($_POST['title'])
        ->setAuthor($_POST['author'])
        ->setCategory($_POST['category'])
        ->setYear($_POST['year'])
        ->setIsbn($_POST['isbn'])
        ->setSlug($_POST['title']);
    Book::addBook($book);
}

require_once 'templates/header.html.php';

?>

<!-- Bibliothèque -->
<div class="text-center mt-4">
    <h2>
        Bibliothèque
        <span class="badge rounded-pill text-bg-primary mx-2">
            <?= $totalBooks; ?>
        </span>
    </h2>
    <button type="button" class="btn btn-outline-dark text-center" data-bs-toggle="modal" data-bs-target="#addBook">
        Ajouter un livre
    </button>
</div>

<div class="row rounded p-3 m-4 gap-4 switch-row justify-content-center">
    <?php include 'templates/_partials/_books-card.html.php'; ?>
</div>

<!-- Modal, TODO: Sécuriser le formulaire et ses données-->
<div class="modal fade" id="addBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Ajouter un livre
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form method="post">

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre du livre</label>
                        <input required name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp">
                        <div id="titleHelp" class="form-text">Saisissez le titre du livre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Auteur du livre</label>
                        <input required name="author" type="text" class="form-control" id="author" aria-describedby="authorHelp">
                        <div id="authorHelp" class="form-text">Saisissez le nom de l'auteur du livre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Choisissez une catégorie</label>
                        <select name="category" list="listCategory" class="form-control" id="category">
                            <option value="roman">Roman</option>
                            <option value="théâtre">Théâtre</option>
                            <option value="biographie">Biographie</option>
                            <option value="poésie">Poésie</option>
                            <option value="essai">Essai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Quelle est l'année de l'édition</label>
                        <input required name="year" type="text" class="form-control" id="year" aria-describedby="yearHelp">
                        <div id="yearHelp" class="form-text">Saisissez l'année au format "1980"</div>
                    </div>

                    <div class="mb-3">
                        <label for="isbn" class="form-label">Fournissez l'ISBN du livre</label>
                        <input required name="isbn" type="text" class="form-control" id="isbn" aria-describedby="isbnHelp">
                        <div id="isbnHelp" class="form-text">Format attendu : "978-2-1234-5680-3"</div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i>
                        Enregistrer
                    </button>

                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
            
        </div>
    </div>
</div>

<?php

require 'templates/footer.html.php';
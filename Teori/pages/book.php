<?php
$deleteCommand = filter_input(INPUT_GET, 'cmd');
if (isset($deleteCommand) && $deleteCommand == 'del') {
    $bookIsbn = filter_input(INPUT_GET, 'isbn');
    $result = deleteBookFromDb($bookIsbn);
    if ($result) {
        echo '<div class="d-flex justify-content-center">Data succesfully removed</div>';
    } else {
        echo '<div class="d-flex justify-content-center">Failed to remove data</div>';
    }
}
$submitPressed = filter_input(INPUT_POST, 'btnSave');
if (isset($submitPressed)) {
    $isbn = filter_input(INPUT_POST, 'isbn');
    $title = filter_input(INPUT_POST, 'judul');
    $author = filter_input(INPUT_POST, 'author');
    $pub = filter_input(INPUT_POST, 'publisher');
    $pubyear = filter_input(INPUT_POST, 'publish_year');
    $desc = filter_input(INPUT_POST, 'desc');
    $cover = filter_input(INPUT_POST, 'cover');
    $id = filter_input(INPUT_POST, 'genre_id');
    if ((trim($isbn) == '') || (trim($title) == '') || (trim($author) == '') || (trim($pub) == '') || (trim($pubyear) == '') || (trim($desc) == '') || (trim($id) == '')){
        echo '<div class="d-flex justify-content-center>Please provide with a valid name</div>';
    } else {
        $results = addNewBook($isbn, $title, $author, $pub, $pubyear, $desc, $cover, $id);
        if ($results) {
            echo '<div class="d-flex justify-content-center">Data Succesfully Loaded</div>';
        } else {
            echo '<div class="d-flex justify-content-center">Failed to add data</div>';
        }
    }
}

?>
<div class="container">
    <div >
            <div class="d-flex justify-content-center">
                <h1>Book</h1>
            </div>
            <form method="post" action="" class="form-horizontal">
                <div class="form-group mb-3" >
                    <label" for="isbn">ISBN</label>
                    <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" required autofocus>
                </div>
                <div class="form-group mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" required autofocus>
                </div>
                <div class="form-group mb-3">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" id="author" placeholder="Author" required autofocus>
                </div>
                <div class="form-group mb-3">
                    <label for="publisher">Publisher</label>
                    <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher" required autofocus>
                </div>
                <div class="form-group mb-3">
                    <label for="publish_year">Publish Year</label>
                    <input type="number" class="form-control" name="publish_year" id="publish_year" placeholder="Publish Year" required autofocus>
                </div>
                <div class="form-group mb-3">
                    <label for="desc">Description</label>
                    <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Short Description" required autofocus></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="genre_id">Genre</label>
                    <select class="form-select" aria-label="Default select example" name="genre_id" id="genre_id" required autofocus>
                        <option selected disabled>Choose Genre</option>
                        <?php
                        $results = fetchGenreFromDb();
                        foreach ($results as $genre) {
                            echo '<option value="' . $genre['id'] . '">' . $genre['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <input class="btn btn-success" type="submit" value="Save Data" name="btnSave">
                </div>
            </form>
        <div>
            <table class="table table-hover" style="text-align: center;">
                <thead class="thead-dark">
                <tr style="border-bottom: 1px;">
                    <th>Cover</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Publish&nbsp;Year</th>
                    <th>Description</th>
                    <th>Genre</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $results = fetchBookFromDb();
                foreach ($results as $book) {
                    echo '<tr>';
                    if($book['cover']!=''){
                        echo '<td>'. $book['cover']. '</td>';
                    }else{
                        echo '<td><img src= "uploads/cover.jpg" style = width:100px; height :auto;> </td>';
                    }
                    echo '<td>' . $book['isbn'] . '</td>';
                    echo '<td>' . $book['title'] . '</td>';
                    echo '<td>' . $book['author'] . '</td>';
                    echo '<td>' . $book['publisher'] . '</td>';
                    echo '<td>' . $book['publish_year'] . '</td>';
                    echo '<td>' . $book['short_description'] . '</td>';
                    echo '<td>' . $book['name'] . '</td>';
                    echo '<td>
                            <button class="btn btn-danger" onclick="addCover(\'' . $book['isbn'] . '\')">Add Cover</i></button>
                            <button class="btn btn-primary" onclick="editBook(\'' . $book['isbn'] . '\')">Update Book</i></button>
                            <button class="btn btn-danger" onclick="deleteBook(\'' . $book['isbn'] . '\')">Delete Book</i></button>
                        </td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/book_index.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
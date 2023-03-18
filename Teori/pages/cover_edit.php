<?php
$bookIdm = filter_input(INPUT_GET, 'isbn');
if(isset($bookid)){
    $uploadRequest = filter_input(INPUT_POST, 'btnUpload');
    if(isset($uploadRequest)){
        $isbn = filter_input(INPUT_GET, 'isbn');
        $fileName = filter_input(INPUT_GET, 'isbn');
        $targetDirectory = 'uploads/';
        $fileExtension = pathinfo($_FILES['imageFile']['name'], PATHINFO_EXTENSION);
        $cover = $fileName.'.'.$fileExtension;
        $pathToUpload = $targetDirectory . $fileName . '.' . $fileExtension;
        if($_FILES['txtFile']['size']>1024*2048){
            echo 'File is to big than 2MB, please resize the file';
        }else{
            move_uploaded_file($_FILES['imageFile']['tmp_name'], $pathToUpload);
            $results = updateCover($isbn, $cover);
            if($results){
                header('location:index.php?menu=book');
            }else{
                echo '<div>Failed to add data</div>';
            }

        }

    }
}
?>
<div class = "container">
    <div>
        <h2>Current Cover</h2>
        <?php
        $book = fetchOneBook($bookIdm);
        if($book['cover']){
            echo '<img src="uploads/'. $book['cover']. '" style="width:100px; height:auto;">';
        }else{
            echo '<img src="uploads/cover.jpg" style="width:100px;height:auto;">';
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <label for ="covered">New Cover</label>
            <div  class="form-group mb-3">
                <input type="file" name="imageFile" accept="image/*" class="form-control">
            </div>
            <div  class="form-group mb-3">
                <input type="submit" name="btnUpload" value="Upload Image" class="btn btn-primary">
            </div>


        </form>
    </div>
</div>
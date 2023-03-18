<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="js/bootstrap.js"></script>

<?php
$genreId = filter_input(INPUT_GET, 'gid');
if (isset($genreId)){
    $genre = fetchOneGenreFromDb($genreId);
}

$updatePressed = filter_input(INPUT_POST, 'btnUpdate');
if (isset($updatePressed)){
    $name = filter_input(INPUT_POST,'txtName');
    if (trim($name) == ''){
        echo 'Please fill a valid genre name';
    } else{
        $result = updateGenreToDb($genreId, $name);
        if ($result){
            header('location:index.php?menu=genre');
        } else{
            echo '<div>Failed to update genre</div>';
        }
    }
}
?>

<form method="post">
    <label for="txtId">Genre ID</label>
    <input type="text" maxlength="45" id="txtName" name="txtName" required autofocus
           placeholder="Genre Id" readonly id="txtId" value="<?php echo $genre['id']; ?>">
    <input type="text" maxlength="45" id="txtName" name="txtName" required autofocus
           placeholder="New Genre Name" value="<?php echo $genre['name']; ?>">
    <input type="submit" name="btnUpdate" value="Update Genre" class="btn btn-success">
</form>
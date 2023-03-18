<?php
    $deleteCommand = filter_input(INPUT_GET,'com');
    if(isset($deleteCommand) && $deleteCommand == 'del'){
        $genreId = filter_input(INPUT_GET,'gid');
        $result = deleteGenreFromDb($genreId);
        if($result){
            echo '<div> Data succesfully deleted</div>';
        }else{
            echo '<div>Failed to delete genre</div>';
        }
    }
    ?>
<?php
    $saveButtonPressed = filter_input(INPUT_POST, 'btnSave');
    if(isset($saveButtonPressed)) {
        $name = filter_input(INPUT_POST, 'txtName');
        if(trim($name)==''){
            echo 'Please fill a valid genre name';
        }else {
            $result = addGenreToDb($name);
            if($result) {
                echo '<div>Data successfulyy added</div>';
            }else{
                echo '<div>Data failed to add genre</div>';
            }
        }
    }
    ?>
    <form method="post">
        <div>
        <label for="txtName">Name</label>
        <input type="text" maxlength="45" id="txtName" name="txtName" required autofocus
               placeholder="New Genre Name">
        <input type="submit" name="btnSave" value="Save Genre" class="btn btn-success">
        </div>
    </form>


    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = fetchGenreFromDb();
        foreach ($result as $genre){

            echo '<tr>';
            echo '<td>' . $genre['id'] . '</td>';
            echo '<td>' . $genre['name'] . '</td>';
            echo '<td> <div class="container">
                    <button onclick="editGenre (' . $genre['id'] . ')" class="btn btn-primary">Edit data</button> 
                        <button onclick="deleteGenre(' . $genre['id'] . ')" class="btn btn-danger">Delete data</button></div>
                </td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <script src="js/genre_index.js">
    </script>

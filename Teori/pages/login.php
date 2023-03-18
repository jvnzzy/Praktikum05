<?php
$loginPressed = filter_input(INPUT_POST,'btnLogin');
if(isset($loginPressed)) {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'pwd');
    if (trim($email) == '' || trim($password) == '') {
        echo '<div>Please fill email and password</div>';
    } else {
        $user = login($email, $password);
        if ($user['email'] == $email) {
            $_SESSION['is_user_logged'] = true;
            $_SESSION['user_name'] = $user['name'];
            header('location:index.php');
        } else {
            echo '<div>Invalid email or password</div>';
        }
    }
}
?>
<div class="container">
    <h2>Login</h2>
    <form method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-default" name="btnLogin">Submit</button>
    </form>
</div>
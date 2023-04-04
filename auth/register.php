<?php
require base_path("database.php");

if(isset($_SESSION['user'])){
    header("location:/");
    exit();
}

$error = "";
$success = "";
$errorName = $errorEmail = $errorPassword = $errorConfirmPassword = "";
$username = $email = $password = $confirmPassword = "";

if (isset($_POST['create'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($username === "" || empty($username)) {
        $errorName = "Username is required.";
    }
    if ($email === "" || empty($email)) {
        $errorEmail = "Email is required.";
    }

    if ($password === "" || empty($password)) {
        $errorPassword = "Password is required.";
    }

    if ($confirmPassword === "" || empty($confirmPassword)) {
        $errorConfirmPassword = "Confirm Passeword is required.";
    }

    if (isset($username) && isset($email) && isset($password) && isset($confirmPassword)) {

        if (strlen($username) > 0 && (strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) && strlen($password) >= 0 && strlen($confirmPassword) >= 0) {

            if ($password === $confirmPassword) {

                $query = sprintf(
                    "SELECT * FROM users WHERE email = '%s'",
                    mysqli_real_escape_string($conn, $email)
                );

                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                if (!empty($row)) {
                    $error = "Email already exist.!";
                } else {
                    $query = sprintf(
                        "INSERT INTO users (username,email,password) VALUES ('%s','%s','%s')",
                        mysqli_real_escape_string($conn, $username),
                        mysqli_real_escape_string($conn, $email),
                        mysqli_real_escape_string($conn, password_hash($password, PASSWORD_BCRYPT))
                    );
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $success = "Register Successful!.";
                        header("location:login");
                    }
                }
            } else {
                $error = "Password and confirm password do not match.!";
            }

        }
    }

}

?>


<?php require base_path("view/header.view.php"); ?>
<?php require base_path("view/nav.view.php"); ?>

<div class="container mt-5">
    <div class="card px-4 py-3" style="width:40%;margin:auto;background-color: #edf2f5;">

        <h5 class="text-center mb-4">Register</h5>

        <?php if (!empty($success)): ?>
            <small class="text-success mb-2">
                <?= $success; ?>
            </small>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <small class="text-danger mb-2">
                <?= $error; ?>
            </small>
        <?php endif; ?>


        <form action="register" method="post">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                <small class="text-danger">
                    <?= $errorName; ?>
                </small>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                    value="<?php echo $email; ?>">
                <small class="text-danger">
                    <?= $errorEmail; ?>
                </small>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                <small class="text-danger">
                    <?= $errorPassword; ?>
                </small>
            </div>
            <div class="form-group mb-3">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword"
                    value="<?php echo $confirmPassword; ?>">
                <small class="text-danger">
                    <?= $errorConfirmPassword; ?>
                </small>
            </div>
            <button type="submit" class="btn btn-primary" name="create">Sign up</button>
        </form>
        <div class="mt-3">
            Already have an account? <a href="login"> Sign In</a>
        </div>
    </div>

    <?php require base_path("view/footer.view.php"); ?>
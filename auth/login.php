<?php

require base_path("database.php");

if (isset($_SESSION['user'])) {
    header("location:/");
    exit();
}

if (isset($_GET['redirect_to'])) {
    $url_query = "?redirect_to=" . $_GET['redirect_to'];
}

$error = "";
$success = "";
$errorEmail = $errorPassword = "";
$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === "" || empty($email)) {
        $errorEmail = "Email is required.";
    }

    if ($password === "" || empty($password)) {
        $errorPassword = "Password is required.";
    }


    if (isset($_POST["email"]) && isset($_POST["password"])) {

        if ((strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) && strlen($password) > 0) {
            $query = sprintf(
                "SELECT * FROM users WHERE email = '%s'",
                mysqli_real_escape_string($conn, $email)
            );

            $result = mysqli_query($conn, $query);

            if (!$result) {
                $error = "Errors when select data.!";

            } else {

                $row = mysqli_fetch_assoc($result);

                if (!empty($row)) {

                    if (password_verify($password, $row['password'])) {
                        login([
                            'id' => $row['id'],
                            'email' => $email,
                            'username' => $row['username'],
                        ]);

                        if(isset($_GET['redirect_to'])) {
                            header('location: ' . $_GET['redirect_to']);
                            exit();
                        } else {
                            header('location: /');
                            exit();
                        }

                    } else {
                        $error = "Your password was wrong.!";
                    }
                } else {
                    $error = "Enter valid email and password.";
                }
            }
        }
    }
}
?>


<?php require base_path("view/header.view.php"); ?>
<?php require base_path("view/nav.view.php"); ?>

<div class="container mt-5">
    <div class="card px-4 py-3" style="width:40%;margin:auto;background-color: #edf2f5;">

        <h5 class="text-center mb-4">Login</h5>

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

        <form action="/login<?= $url_query ?? ''?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="<?php echo $email; ?>">
                <small class="text-danger">
                    <?= $errorEmail; ?>
                </small>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    value="<?php echo $password; ?>">
                <small class="text-danger">
                    <?= $errorPassword; ?>
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <div class="mt-3">
            Do you have an account? <a href="register"> Sign Up</a>
        </div>

    </div>

    <?php require base_path("view/footer.view.php"); ?>
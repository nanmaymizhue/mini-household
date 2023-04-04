<?php
require base_path("database.php");

$error = "";
$success = "";
$errorDate = $errorDescription = $errorAmount = "";
$isError=false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user']['id'];

    $query = sprintf(
        "SELECT * FROM cashflows WHERE id= '%d' AND user_id = '%d'",
        mysqli_real_escape_string($conn, $id),
        mysqli_real_escape_string($conn, $user_id),
    );

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_GET['id'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $selectedRadio = $_POST['radioBtn'];

    $income = 0;
    $expense = 0;

    if ($date === '' || empty($date)) {
        $errorDate = "Date is required.";
        $isError = true;
    }
    if ($description === '' || empty($description)) {
        $errorDescription = "Description is required.";
        $isError=true;
    }
    if ($amount === '' || empty($amount) || $amount === 0) {
        $errorAmount = "Amount is required.";
        $isError=true;
    }

    if ($selectedRadio === 'income') {
        $income = (double) ($amount);
        $expense = 0;
    } else {
        $expense = (double) ($amount);
        $income = 0;
    }

    if (!$isError) {
        $user_id=$_SESSION['user']['id'];
        $query = sprintf(
            "UPDATE cashflows SET date = '%s',description = '%s',income = '%d',expense = '%d' WHERE id = '%d' AND user_id = $user_id",
            mysqli_real_escape_string($conn, $date),
            mysqli_real_escape_string($conn, $description),
            mysqli_real_escape_string($conn, $income),
            mysqli_real_escape_string($conn, $expense),
            mysqli_real_escape_string($conn, $_GET['id'])
        );

        $result = mysqli_query($conn, $query);

        if ($result) {
            $success = "Cashflow has been updated.!";
            header("location:cashflow");
        } else {
            $error = "Failed to update cashflow.!";
        }
    }

}

?>

<?php require base_path("view/header.view.php"); ?>
<?php require base_path("view/nav.view.php"); ?>


<div class="container mt-5">
    <div class="card px-4 py-4" style="width:40%;margin:auto;background-color: #edf2f5;">

        <h5 class="text-center">Edit Cashflow</h5>

        <?php if (!empty($success)): ?>
            <small class="text-success my-2 px-3">
                <?= $success; ?>
            </small>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <small class="text-danger my-2 px-3">
                <?= $error; ?>
            </small>
        <?php endif; ?>

        <div class="px-3 py-3">
            <form action="update-cashflow?id=<?= $id ?>" method="post">
                <div class="mb-4">
                    <input type="date" name="date" class="form-control" value="<?= $row['date']; ?>">
                    <small class="text-danger">
                        <?= $errorDate; ?>
                    </small>
                </div>
                <div class="mb-4">
                    <input type="text" name="description" class="form-control" value="<?= $row['description']; ?>">
                    <small class="text-danger">
                        <?= $errorDescription; ?>
                    </small>
                </div>
                <div class="mb-4">
                    <div class="mb-4">
                        <input type="number" name="amount" class="form-control"
                            value="<?php echo ($row['income'] != 0) ? $row['income'] : $row['expense'] ?>">
                        <small class="text-danger ">
                            <?= $errorAmount; ?>
                        </small>
                    </div>
                    <?php if($row['income'] == 0):?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="income" name="radioBtn" value="income">
                        <label class="form-check-label" for="income">Income</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="expense" name="radioBtn" value="expense" checked>
                        <label class="form-check-label" for="expense">Expense</label>
                    </div>
                    <?php else: ?>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="income" name="radioBtn" value="income" checked>
                        <label class="form-check-label" for="income">Income</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="expense" name="radioBtn" value="expense">
                        <label class="form-check-label" for="expense">Expense</label>
                    </div>
                    <?php endif; ?>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>


<?php require base_path("view/footer.view.php");
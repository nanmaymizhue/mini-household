<?php
require base_path("database.php");

$error = "";
$success = "";
$errorDate = $errorDescription = $errorAmount = $errorRadio = "";
$date = $description = $amount = $selectedRadio = "";
$isError = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $selectedRadio = $_POST['radioBtn'];

    $user_id = $_SESSION['user']['id'];

    if ($date === '' || empty($date)) {
        $errorDate = "Date is required.";
        $isError = true;
    }
    if ($description === '' || empty($description)) {
        $errorDescription = "Description is required.";
        $isError = true;
    }
    if ($amount === '' || empty($amount)) {
        $errorAmount = "Your amount is required.";
        $isError = true;
    }

    if (!isset($selectedRadio)) {
        $errorRadio = "Please select one for amount.";
        $isError = true;
    }

    if (!$isError) {
        $income = 0;
        $expense = 0;

        if ($selectedRadio == 'income') {
            $income = (double) ($amount);
            $expense = 0;

        } else {
            $expense = (double) ($amount);
            $income = 0;

        }

        $query = sprintf(
            "INSERT INTO cashflows (date,description,income,expense,user_id) VALUES ('%s','%s','%d','%d','%s')",
            mysqli_real_escape_string($conn, $date),
            mysqli_real_escape_string($conn, $description),
            mysqli_real_escape_string($conn, $income),
            mysqli_real_escape_string($conn, $expense),
            mysqli_real_escape_string($conn, $user_id),
        );

        $result = mysqli_query($conn, $query);

        if ($result) {
            $success = "Create cashflow successful.!";
            header("location:cashflow");
        } else {
            $error = "Create cashflow failed.!";
        }

    }


}

?>

<?php require base_path("view/header.view.php"); ?>
<?php require base_path("view/nav.view.php"); ?>

<div class="container mt-5">
    <div class="card px-4 py-4" style="width:40%;margin:auto;background-color: #edf2f5;">

        <h5 class="text-center">Add Cashflow</h5>

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
            <form action="" method="post">
                <div class="mb-4">
                    <input type="date" name="date" class="form-control" placeholder="Enter Date"
                        value="<?php echo $date; ?>">
                    <small class="text-danger">
                        <?= $errorDate; ?>
                    </small>
                </div>
                <div class="mb-4">
                    <input type="text" name="description" class="form-control" placeholder="Enter Description"
                        value="<?php echo $description; ?>">
                    <small class="text-danger">
                        <?= $errorDescription; ?>
                    </small>
                </div>
                <div class="mb-4">
                    <div class="mb-4">
                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount"
                            value="<?php echo $amount; ?>">
                        <small class="text-danger">
                            <?= $errorAmount; ?>
                        </small>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="income" name="radioBtn" value="income" checked>
                        <label class="form-check-label" for="income">Income</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="expense" name="radioBtn" value="expense">
                        <label class="form-check-label" for="expense">Expense</label>
                    </div>
                    <div class="text-danger">
                        <?= $errorRadio; ?>
                    </div>
                </div>
                <div>
                    <button type="submit" name="createExpense" class="btn btn-primary">Add</button>
                </div>

            </form>
        </div>
    </div>
</div>


<?php require base_path("view/footer.view.php"); ?>
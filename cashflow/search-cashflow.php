<?php
require base_path("database.php");

$error = "";
if (!isset($_SESSION['user'])) {
    header('location: /login?redirect_to=/cashflow');
} else {

    if (isset($_POST['submit'])) {       

        $searchDate = $_POST['searchDate'];
        $user_id = $_SESSION['user']['id'];

        $query = "SELECT * FROM cashflows WHERE date='$searchDate' AND user_id = $user_id";

        $result = mysqli_query($conn, $query);

    } else {
        $error = "Get Method is not support.!";
    }
}

?>

<?php
require base_path('view/header.view.php');

require base_path('view/nav.view.php');
?>

<div class="container">

    <h3 class="text-center my-4">Cashflow List</h3>

    <div style="display:flex;flex-direction:row;justify-content:space-between">
        <div class="mb-3 px-2">Do you add your cashflows?
            <a class="text-decoration-none" href="add-cashflow">
                <i class="fa-solid fa-circle-plus"></i>
            </a>
        </div>
        <form method="post" action="/search-cashflow" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="input-group px-3">
                <input type="date" class="form-control" name="searchDate" id="inlineFormInputGroupUsername"
                    placeholder="Search by date" value="<?php echo $searchDate; ?>" />
                <button type="submit" name="submit" class="btn btn-primary p-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
    </div>

    <?php if (!empty($error)): ?>
        <div class="text-danger text-center my-2 px-3">
            <?= $error; ?>
        </div>
    <?php endif; ?>

    <div class="card" style="background-color: #edf2f5;">

        <table class="table table-bordered table-striped">
            <thead style="background-color:#a3bcf7">
                <tr>
                    <th scope="col">DATE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">INCOME</th>
                    <th scope="col">EXPENSE</th>
                    <th scope="col">BALANCE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $balance = 0;
                    while ($row = mysqli_fetch_assoc($result)):

                        $date = $row['date'];
                        $dateObject = new DateTime($date);
                        ?>
                        <tr>
                            <td>
                                <?= date_format($dateObject,'Y-M-d'); ?>
                            </td>
                            <td>
                                <?= $row['description'] ?>
                            </td>
                            <td>
                                <?= $row['income'] ?>
                            </td>
                            <td>
                                <?= $row['expense'] ?>
                            </td>
                            <td>
                                <?php
                                $calBalance = (double) ($row['income']) - (double) ($row['expense']);
                                $balance = $calBalance + $balance;
                                echo number_format($balance);
                                ?>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-success p-1 mx-2" href="update-cashflow?id=<?= $row['id']; ?>">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-danger p-1" href="#" data-bs-toggle="modal" data-bs-target="#deleteCashFlow">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>

                        <?php require base_path("cashflow/delete-cashflow-modal.php"); ?>

                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center text-danger m-3">No data for this search.!</div>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- <?php require base_path("cashflow/cashflow-pagination.php"); ?>  -->

</div>
<?php require base_path('view/footer.view.php'); ?>
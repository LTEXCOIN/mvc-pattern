<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo APP_URL ?>asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>asset/css/font-awesome.min.css"/>

    <title>Form Submission</title>
</head>
<body>
<div class="container">

    <h2 class="text-center">Data Table</h2>
    <hr>
    <div class="row">
        <form action="" method="get">
            <div class="col-md-6">
                <label for="">User ID</label>
                <select name="entry_by" id="" class="form-control">
                    <option value="">Select User Id</option>
                    <?php foreach ($data['results'] as $result) { ?>
                        <option value="<?php echo $result->entry_by; ?>"><?php echo $result->entry_by; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="">Starting Date</label>
                <input type="date" name="starting_date">
            </div>
            <div class="col-md-6">
                <label for="">Ending Date</label>
                <input type="date" name="ending_date">
            </div>

            <div class="col-md-5 mt-2">
                <button class="btn btn-sm btn-primary">Search</button>
            </div>

        </form>
    </div>
    <br>
    <br>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Amount</th>
            <th>Buyer</th>
            <th>Receipt Id</th>
            <th>Buyer Email</th>
            <th>Buyer IP</th>
            <th>Phone</th>
        </tr>
        <?php foreach ($data['results'] as $result) { ?>
            <tr>
                <td><?= $result->amount ?></td>
                <td><?= $result->buyer ?></td>
                <td><?= $result->receipt_id ?></td>
                <td><?= $result->buyer_email ?></td>
                <td><?= $result->buyer_ip ?></td>
                <td><?= $result->phone ?></td>
            </tr>
        <?php } ?>

    </table>
    <a href="<?php echo APP_URL ?>home/index">Back</a>

</div>

<script src="<?php echo APP_URL; ?>asset/js/jquery-3.2.1.min.js"
"></script>
<script src="<?php echo APP_URL; ?>asset/js/popper.min.js"></script>
<script src="<?php echo APP_URL; ?>asset/js/bootstrap.min.js"></script>
<script src="<?php echo APP_URL; ?>asset/js/main.js"></script>
</body>
</html>
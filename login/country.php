<?php
include('config.php');
session_start();
if (empty($_SESSION['admin_user_email'])) {
    header('Location: logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section>
        <?php include('sidebar.php'); ?>
        <div class="p-5 content_box">
            <?php
            $query = "SELECT * FROM countries";
            $result = mysqli_query($conn, $query) or die('Country query failed');
            if (mysqli_num_rows($result) < 1) {
                echo '<h5 class="text-center">No country found</h5>';
            } else {
            ?>
                <div class="buttons">
                    <a href="block_all.php" class="text-white p-2 rounded bg-danger block_all_countries">Block All Countries</a>
                    <a href="unblock_all.php" class="text-white p-2 rounded bg-success block_all_countries">Unblock All Countries</a>
                    <div id="status_selector_container">
                        <label for="">Blocked/Unblocked:</label>
                        <select id="status_selector" class="form-control">
                            <option value="all">All</option>
                            <option value="unblocked">Unblocked</option>
                            <option value="blocked">Blocked</option>
                        </select>
                    </div>
                </div>
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Country Key</th>
                            <th scope="col">Country Name</th>
                            <th scope="col">Third Party Url</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['code']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><button data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#modal" class="url-button <?php if ($row['url'] !== NULL) {
                                                                                                                                                echo 'bg-success';
                                                                                                                                            } else {
                                                                                                                                                echo 'bg-primary';
                                                                                                                                            }
                                                                                                                                            ?> text-white px-2 rounded">Set Url <?php if ($row['url'] !== NULL) {
                                                                                                                                                                                    echo '<i class="fa-solid fa-link text-white"></i>';
                                                                                                                                                                                } ?> </button></td>
                                <?php
                                if ($row['is_blocked'] === '0') {
                                    echo "<td><a href='block.php?country_id=$row[id]' class='bg-danger text-white px-2 py-1 rounded'>Block</a></td>";
                                } else {
                                    echo "<td><a href='unblock.php?country_id=$row[id]' class='bg-success text-white px-2 py-1 rounded'>Unblock</a></td>";
                                }
                                ?>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
        </div>
    <?php }; ?>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Update Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="url">Third Party URL:</label>
                    <input id="url" type="url" class="form-control">
                    <label for="url">Status:</label>
                    <select id="status" class="form-control">
                        <option value="1">Enabled</option>
                        <option value="0">Disabled</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="save_button" type="button" class="btn btn-primary">Save Data</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
</body>

</html>
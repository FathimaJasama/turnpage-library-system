<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Message.php';

$messageModel = new Message();
$messages = $messageModel->getAll();

?>
<div class="content-wrapper-scroll">

<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-envelope"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>Messages</h5>
        </div>
    </div>

</div>
<!-- Main header ends -->

<div class="content-wrapper">
	<div class="subscribe-header">
    <section class="content m-3">
        
        <div class="container-fluid">
            
            <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="d-flex align-items-center m-3">
                    <i class="bi bi-search"></i>
                        <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Search Messages" aria-label="Search..." />
                    </div>
                </div>
                 <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="">Name</th>
                                <th class="">Email</th>
                                <th class="">Messages</th>
                                <th class="">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($messages as $key => $c) {
                            ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['Name'] ?? "";?></td>
                                    <td><h6> <?= $c['EmailId'] ?? ""; ?> </h6></td>
                                    <td> <?= $c['Message'] ?? ""; ?></td>
                                    <td> <?= $c['created_at'] ?? ""; ?> </td>                                    
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>



<?php
require_once('../layouts/Footer.php');
?>

<script>

// To create search bar
$("#searchInput").on("input", function() {
    var searchTerm = $(this).val().toLowerCase();

    // Loop through each row in the table body
    $("tbody tr").filter(function() {
        // Toggle the visibility based on the search term
        $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
    });
});

</script>

    
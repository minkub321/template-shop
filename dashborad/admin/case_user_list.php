<?php 
include("condb.php"); // Connect to the database

// Updated SQL query to retrieve cases with user and status details
$query_case = "SELECT c.*, u.user_name AS username, s.status_name, u.num_phone AS phone_emy, u.email, s.status_id
    FROM repair_case AS c
    INNER JOIN user_table AS u ON c.user_id = u.user_id
    INNER JOIN repair_status AS s ON c.status_id = s.status_id
    ORDER BY c.case_id ASC";

$result = mysqli_query($con, $query_case);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Cases</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom Styling */
        thead tr {
            background-color: #343a40;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-sm {
            margin: 2px;
        }
        .badge {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Repair Case Management</h2>
        <table id="example1" class="table table-hover table-bordered text-nowrap">
            <thead>
                <tr>
                    <th style="width: 5%;">เคส</th>
                    <th style="width: 10%;">รายระเอียดผู้เเจ้ง</th>
                    <th style="width: 10%;">รายระเอียดงาน</th>
                    <th style="width: 10%;">สถานที่</th>
                    <th style="width: 10%;">สถานะ</th>
                    <th style="width: 15%;">วันเเละเวลา</th>
                    <th style="width: 10%;">การกระทำ</th>
                </tr>   
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?> 
                <tr>
                    <td><?php echo $row['case_id']; ?></td>
                    <td>
                        <strong><?php echo $row['username']; ?></strong><br>
                        <small>Phone: <?php echo $row['phone_emy']; ?></small><br>
                        <small>Email: <?php echo $row['email']; ?></small>
                    </td>
                    <td><?php echo $row['name_case']; ?></td>
                    <td><?php echo $row['place_case']; ?></td>
                    <td>
                        <span class="badge bg-<?php echo ($row['status_id'] == 1) ? 'warning' : 'success'; ?>">
                            <?php echo $row['status_name']; ?>
                        </span>
                    </td>
                    <td><?php echo date("d/m/Y ,H:i:s", strtotime($row['date_case'])); ?></td>
                    <td class="action-buttons">
                        <?php if ($row['status_id'] == 1) { ?>
                            <a class="btn btn-danger btn-sm" href="index.php?act=add&case_id=<?php echo $row['case_id']; ?>">
                                <i class="bi bi-tools"></i> เลือกช่าง
                            </a>
                        <?php } elseif ($row['status_id'] == 2) { ?>
                            <a class="btn btn-success btn-sm">
                                <i class="bi bi-check-circle"></i> มอบเเล้ว
                            </a>
                        <?php } ?>
                    </td>  
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

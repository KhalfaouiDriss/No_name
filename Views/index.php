<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "components/header.php"; ?>
    <?php
    include '../Config/config.php';

    // include_once '../../Models/api_pip/api.php' 
    ?>

    <style>
        /* Common styles for progress container */
        .progress-container {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin: 10px auto;
        }

        /* Line progress (default for desktop) */
        .progress-line {
            display: flex;
            align-items: center;
            width: 80%;
            height: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .progress-line .fill {
            background: #4caf50;
            height: 100%;
            width: 70%;
            /* Set progress percentage */
            transition: width 0.3s ease;
        }

        .progress-line .percentage {
            position: absolute;
            right: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        /* Circle progress (for mobile) */
        .progress-circle {
            display: none;
            /* Hidden on larger screens */
            justify-content: center;
            align-items: center;
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: conic-gradient(#4caf50 0% var(--progress, 70%), #e0e0e0 var(--progress, 70%) 100%);
        }

        .progress-circle .percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }

        /* Responsive behavior */
        @media (max-width: 768px) {
            .progress-line {
                display: none;
                /* Hide line progress on smaller screens */
            }

            .progg {
                display: ;
            }

            .progress-circle {
                display: flex;
                /* Show circle progress on smaller screens */
            }

            .progress-circle {
                width: 20px;
                height: 20px;
            }

            .progress-circle .percentage {
                font-size: 0.9rem;
            }
        }

        /* Table Styling */
        .table {
            width: 100%;
            margin: 1rem 0;
            border-collapse: collapse;
            font-size: 14px;
        }

        /* Add some padding, font size, and alignment */
        .table th,
        .table td {
            padding: 10px;
            text-align: center;
        }

        /* Header Styling */
        .thead-dark {
            background-color: #343a40;
            color: #fff;
        }

        /* Style for the image in the table */
        .table-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Status Indicator */
        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        /* Active Status */
        .status-indicator.active {
            background-color: #28a745;
            /* Green */
        }

        /* Inactive Status */
        .status-indicator.inactive {
            background-color: #dc3545;
            /* Red */
        }

        /* Hover effect for rows */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        /* Make sure the table is responsive */
        @media (max-width: 768px) {

            .table th,
            .table td {
                padding: 8px;
                font-size: 12px;
            }

            .table-img {
                width: 30px;
                height: 30px;
            }
        }

        /* Make the table responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Ensure progress bar is visible and properly styled */
        .progress-container {
            width: 100%;
            max-width: 250px;
            /* Limit the width for small screens */
        }

        .progress-line {
            background-color: #e9ecef;
            border-radius: 5px;
            height: 10px;
        }

        .fill {
            height: 100%;
            border-radius: 5px;
            background-color: #4caf50;
            /* Green fill for the progress */
        }

        .percentage {
            font-size: 12px;
            font-weight: bold;
            text-align: right;
        }

        /* Style for status badge */
        .badge {
            padding: 5px 10px;
            border-radius: 10px;
            color: #fff;
        }

        /* Media Queries for small screens */
        @media (max-width: 768px) {

            .table th,
            .table td {
                padding: 8px;
                font-size: 12px;
            }

            /* Adjust progress bar for small screens */
            .progress-container {
                display: block;
                max-width: 200px;
                /* Limit the max-width to avoid taking too much space */
                margin: 0 auto;
                /* Center the progress bar */
            }

            .progress-line {
                height: 8px;
                /* Reduce height of progress bar on small screens */
            }

            .percentage {
                font-size: 10px;
            }

            /* Allow the table to scroll horizontally on smaller screens */
            .table-responsive {
                margin-bottom: 15px;
                /* Optional margin for scrollable table */
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Gestion Accidents</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <?php include 'components/slidebar.html'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-users"></i>
                                    agent active
                                </div>
                                <div class="card-body" style="max-height:330px; overflow-y:scroll;">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">#Nom</th>
                                                <th scope="col">#role</th>
                                                <th scope="col">#Status</th> <!-- Active/Inactive indicator -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><img src="../stock/profel_img/dkhalfao.jpg"
                                                        alt="user image" class="table-img"></td>
                                                <td>khalfaoui driss</td>
                                                <td>admin</td>
                                                <td>
                                                    <!-- <span class="status-indicator active"></span> -->
                                                    <!-- Active status example -->
                                                    <span class="status-indicator inactive"></span>
                                                </td>
                                            </tr>
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Date creation</th>
                                        <th>Status</th>
                                        <th class="progg">Progress</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Date creation</th>
                                        <th>Status</th>
                                        <th class="progg">Progress</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    // Query to get the last 50 entries sorted by date_creation
                                    $dossiers_encoure_query = "SELECT * FROM dossiers WHERE statut != 'complet' AND statut != 'en attente' AND progress > 0 ORDER BY date_creation DESC LIMIT 50";
                                    $dossiers_encoure_queryresult = mysqli_query($conn, $dossiers_encoure_query);
                                    $dossiers_encoure_rows = mysqli_fetch_all($dossiers_encoure_queryresult, MYSQLI_ASSOC);

                                    foreach ($dossiers_encoure_rows as $row): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['reference']); ?></td>
                                            <td><?php echo htmlspecialchars($row['date_creation']); ?></td>
                                            <td>
                                                <span class="badge"
                                                    style="background-color: <?php echo getStatusColor($row['statut']); ?>;">
                                                    <?php echo htmlspecialchars($row['statut']); ?>
                                                </span>
                                            </td>
                                            <td class="progress-container progg">
                                                <div class="progress-line">
                                                    <div class="fill"
                                                        style="width: <?php echo htmlspecialchars($row['progress']); ?>%;">
                                                    </div>
                                                </div>
                                                <div class="percentage">
                                                    <?php echo htmlspecialchars($row['progress']); ?>%
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </main>
            <?php include "components/footer.html"; ?>
        </div>
    </div>
    <script>
        <?php
        function getStatusColor($statut)
        {
            switch (strtolower($statut)) {
                case 'complet':
                    return '#4caf50'; // أخضر
                case 'commence':
                    return 'blue';
                case 'incomplet':
                    return 'orange'; // أحمر
                default:
                    return '#9e9e9e'; // رمادي للحالات غير المعروفة
            }
        }
        ?>


    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: '# of Dossier',
                    data: [3000, 3200],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    </script>

</body>

</html>
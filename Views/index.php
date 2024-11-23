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

            .progress-circle {
                display: flex;
                /* Show circle progress on smaller screens */
            }

            .progress-circle {
                width: 40px;
                height: 40px;
            }

            .progress-circle .percentage {
                font-size: 0.9rem;
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
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Referance</th>
                                        <th>Date creation</th>
                                        <th>status</th>
                                        <th>agent</th>
                                        <th>progress</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Referance</th>
                                        <th>Date creation</th>
                                        <th>status</th>
                                        <th>agent</th>
                                        <th>progress</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $dossiers_encoure_query = "SELECT * FROM dossiers WHERE statut = 'en cours'";

                                    $dossiers_encoure_queryresult = mysqli_query($conn, $dossiers_encoure_query);
                                    $dossiers_encoure_row = mysqli_fetch_all($dossiers_encoure_queryresult, MYSQLI_ASSOC);

                                    // while ($dossiers_encoure_row) { 
                                        ?>
                                        <tr>
                                            <td><?php echo $dossiers_encoure_row['reference'] ?></td>
                                            <td><?php echo $dossiers_encoure_row['date_creation'] ?></td>
                                            <td><?php echo $dossiers_encoure_row['statut'] ?></td>
                                            <td><?php echo $dossiers_encoure_row[''] ?></td>

                                            <td class="progress-container">
                                                <!-- Line Progress for PC -->
                                                <div class="progress-line">
                                                    <div class="fill"
                                                        style="width:<?php echo $dossiers_encoure_row['progress'] ?>%;">
                                                    </div>
                                                    <!-- Set progress width dynamically -->
                                                    <div class="percentage">70%</div>
                                                </div>

                                                <!-- Circle Progress for Mobile -->
                                                <div class="progress-circle"
                                                    style="--progress: <?php $dossiers_encoure_row['progress'] ?>%;">
                                                    <div class="percentage">70%</div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "components/footer.html"; ?>
        </div>
    </div>

</body>

</html>
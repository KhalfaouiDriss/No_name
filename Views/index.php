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

        .test {
            width: 320px;
            height: 500px;
            margin: 10px;
            overflow: hidden;
            border: 1px solid #ccc;
            position: relative;
        }

        .test iframe {
            width: 100%;
            overflow: hidden;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include 'components/navbar.php' ?>
    <div id="layoutSidenav">
        <?php include 'components/slidebar.html';?>
        
        <?php
        if (isset($_GET['page']) && $_GET['page'] == 'index') {
            include "dashboard.php";
        } else if (isset($_GET['page']) && $_GET['page'] == 'views_dos') {
            include "views_dos.php";
        } else if (isset($_GET['page']) && $_GET['page'] == 'view_doc' && isset($_GET['id'])) {
            $_GET['id'] = htmlspecialchars($_GET['id']);
            include "view_doc.php";
        } else if (isset($_GET['page']) && $_GET['page'] == 'creat_dos') {
            include "creat_dos.php";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
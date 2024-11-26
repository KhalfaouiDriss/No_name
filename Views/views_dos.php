<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
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
                                <th>Documents</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Reference</th>
                                <th>Date creation</th>
                                <th>Status</th>
                                <th class="progg">Progress</th>
                                <th>Documents</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            // Query to get the last 50 entries sorted by date_creation
                            $dossiers_encoure_query = "SELECT * FROM dossiers WHERE statut != 'complet' AND progress >= 0 ORDER BY -date_creation";
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
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    href="index.php?page=view_doc&id=<?php echo $row['id_dossier'] ?>">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
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
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            
            <!-- Add New Agent Button -->
            <div class="mb-4 text-end">
                <a href="add_agent.php" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add New Agent
                </a>
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
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Role</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Role</th>
                                <th>Statut</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            // Query to get agents data
                            $agents_query = "SELECT * FROM agents";
                            $agents_queryresult = mysqli_query($conn, $agents_query);
                            $agents_query_rows = mysqli_fetch_all($agents_queryresult, MYSQLI_ASSOC);

                            foreach ($agents_query_rows as $row): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                                    <td>
                                        <?php
                                        // Display color-coded circle based on status
                                        $statut = $row['statut'];
                                        if ($statut == 1) {
                                            echo '<span class="status-circle active"></span>';
                                        } else if ($statut == 0) {
                                            echo '<span class="status-circle inactive"></span>';
                                        }
                                        ?>
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

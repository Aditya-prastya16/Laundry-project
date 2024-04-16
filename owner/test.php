<?php
require "../koneksi.php";

// Assuming $koneksi is your database connection
$sql = "SELECT id_outlet, COUNT(*) AS total_transactions
        FROM tb_transaksi
        GROUP BY id_outlet
        ORDER BY total_transactions DESC";
$result = mysqli_query($koneksi, $sql);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = "Outlet " . $row['id_outlet'];
    $data[] = $row['total_transactions'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
<canvas id="transactionsPerOutletChart1"></canvas>
<canvas id="transactionsPerOutletChart2"></canvas>

<script>
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($data); ?>;

    // Configuration for the first chart
    const config1 = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Transactions per Outlet',
                data: data,
                // Other chart options...
            }]
        },
        // Other chart options...
    };

    // Configuration for the second chart
    const config2 = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Transactions per Outlet',
                data: data,
                // Other chart options...
            }]
        },
        // Other chart options...
    };

    // Initialize the first chart
    const myBarChart = new Chart(
        document.getElementById('transactionsPerOutletChart1'),
        config1
    );

    // Initialize the second chart
    const myLineChart = new Chart(
        document.getElementById('transactionsPerOutletChart2'),
        config2
    );
</script>



</body>
</html>
<?php
// Include necessary files
include_once 'auth.php'; // Ensure the user is authenticated as an admin
include_once '../inc/db.php'; // Include database connection
include_once '../inc/header.php'; // Include header

// Fetch all user submissions from the database
$sql = "SELECT * FROM speaker_info";
$result = $conn->query($sql);

// Check if there are any submissions
if ($result->num_rows > 0) {
    // Display table headers
    echo '<div class="container py-5 my-5" id="table-container">';

    // Offer CSV download button
    echo '<div class="mb-5 text-end ms-auto">';
    echo '<button id="download" class="btn btn-outline-primary">Download CSV</button>';
    echo '</div>';

    echo '<table id="user-table" class="table table-striped table-hover" border="1">';
    echo '<thead><tr><th>Email</th><th>Name</th><th>Organization</th><th>Role</th><th>Photo</th><th>Bio</th><th>Created At</th><th>Modified At</th></tr></thead>';
    echo '<tbody>';

    // Output data rows
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['organization'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
        echo '<td>' . $row['photo'] . '</td>';
        echo '<td>' . $row['bio'] . '</td>';
        echo '<td>' . $row['created_at'] . '</td>';
        echo '<td>' . $row['modified_at'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
    echo '</div>';
    
} else {
    echo '<p>No submissions found.</p>';
}

// Close database connection
$conn->close();
?>

<!-- JavaScript to generate CSV and trigger download -->
<script>
document.addEventListener("DOMContentLoaded", () => {

    // Function to convert data to CSV format
    function convertToCSV(data) {
        const header = Object.keys(data[0]).join(',') + '\n';
        const rows = data.map(row => Object.values(row).join(',')).join('\n');
        return header + rows;
    }

    // Function to trigger download
    function downloadCSV(data) {
        const csv = convertToCSV(data);

        // Create Blob
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });

        // Create link element
        const link = document.createElement('a');
        if (link.download !== undefined) {
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'data.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }

    // Function to extract data from the table
    function extractDataFromTable() {
        const table = document.getElementById('user-table');
        const headers = Array.from(table.querySelectorAll('th')).map(th => th.textContent);
        const rows = Array.from(table.querySelectorAll('tbody tr')).map(tr => {
            const rowData = {};
            Array.from(tr.querySelectorAll('td')).forEach((td, index) => {
                rowData[headers[index]] = td.textContent;
            });
            return rowData;
        });
        return rows;
    }

    // Button to trigger download
    const downloadButton = document.getElementById('download');
    downloadButton.addEventListener('click', () => {
        const data = extractDataFromTable();
        downloadCSV(data);
    });

});
</script>

<?php include_once '../inc/footer.php'; ?>

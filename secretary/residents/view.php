<?php
// Database connection
$servername = "localhost"; // or your server IP
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "gabi"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Fetch all residents
    $sql = "SELECT * FROM residents";
    $result = $conn->query($sql);

    $residents = [];
    while ($row = $result->fetch_assoc()) {
        $residents[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Residents - Secretary Dashboard</title>
   <link rel="stylesheet" href="../dashboard.css">
     <link rel="stylesheet" href="index.css">
 <style>
     /* Style for the table */
        table {
            width: 100%;
            border-collapse: collapse; /* Collapses borders for a cleaner look */
        }

        th, td {
            padding: 10px; /* Adds padding for better spacing */
            text-align: left; /* Aligns text to the left */
            border-bottom: 1px solid #ddd; /* Adds a bottom border to each row */
        }

        /* Change background color on hover */
        tr:hover {
            background-color: #f2f2f2; /* Light gray background on hover */
        }

        /* Style for table headers */
        th {
            background-color: #4CAF50; /* Green background for header */
            color: white; /* White text color for header */
        }

        /* Style for the filter section */
        .filter {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd; /* Line separating filter from table */
            padding-bottom: 10px; /* Adds padding to the filter section */
        }
    </style>
</head>
<body>
      <header>
        <div class="title">
            <li><a href="dashboard.php" class="nav-link">Secretary</a></li>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="../home/index.php" class="nav-link">Home</a></li>
                <li><a href="../files/index.php" class="nav-link">Files</a></li>
                <li><a href="index.php" class="nav-link">Residents</a></li>
                <li><a href="../reports/index.php" class="nav-link">Report</a></li>
                <li><a href="../seminar/index.php" class="nav-link">Seminar</a></li>
                <li><a href="../benefits/index.php" class="nav-link">Government Beneficiaries</a></li>
                 <li><a href="../index.php" class="nav-link">Barangay Info</a></li>
                <li><a href="../logout.php" class="nav-link logout-btn">Logout</a></li>
            </ul>
            </ul>
        </nav>
    </header>
    <main>
        <h2>View Residents Record</h2>
         <div class="container">
        <div></div> <!-- Empty div to fill space -->
        <a href="create.php" class="button">Create Resident Record</a>
    </div>

      <!-- Filter Form -->
<form id="filterForm">
    <input type="text" id="last_name" placeholder="Last Name">
    <input type="text" id="first_name" placeholder="First Name">
    <input type="text" id="extension_name" placeholder="Extension Name">
    <input type="text" id="middle_name" placeholder="Middle Name">
    <input type="date" id="birthday" placeholder="Birthday">
    <input type="number" id="age" placeholder="Age" min="0">
    <select id="marital_status">
        <option value="">Select Marital Status</option>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Widowed">Widowed</option>
        <option value="Single Parent">Single Parent</option>
    </select>
    <input type="text" id="purok" placeholder="Purok">
    <input type="text" id="source_of_income" placeholder="Source of Income">
    <select id="house_ownership">
        <option value="">Select House Ownership</option>
        <option value="Renting">Renting</option>
        <option value="Own">Own</option>
    </select>
    <select id="light_source">
        <option value="">Select Light Source</option>
        <option value="MECO">MECO</option>
        <option value="Solar">Solar</option>
        <option value="Gas Lamp">Gas Lamp</option>
    </select>
    <select id="water_source">
        <option value="">Select Water Source</option>
        <option value="Deep well">Deep well</option>
        <option value="Puso">Puso</option>
        <option value="MCWD">MCWD</option>
    </select>
    <input type="text" id="pets" placeholder="Pets">
    <select id="beneficiaries">
        <option value="">Select Beneficiaries</option>
        <option value="4PS">4PS</option>
        <option value="Senior Citizen">Senior Citizen</option>
        <option value="PWD">PWD</option>
        <option value="Single Parents">Single Parents</option>
    </select>
    <input type="button" value="Filter" onclick="filterResidents()">
</form>

<!-- Display the residents -->
<table id="residentsTable">
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Extension Name</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Marital Status</th>
            <th>Purok</th>
            <th>Source of Income</th>
            <th>House Ownership</th>
            <th>Light Source</th>
            <th>Water Source</th>
            <th>Pets</th>
            <th>Beneficiaries</th>
        </tr>
    </thead>
    <tbody id="residentsBody">
        <?php foreach ($residents as $row): ?>
        <tr>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['middle_name']; ?></td>
            <td><?php echo $row['extension_name']; ?></td>
            <td><?php echo $row['birthday']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['marital_status']; ?></td>
            <td><?php echo $row['purok']; ?></td>
            <td><?php echo $row['source_of_income']; ?></td>
            <td><?php echo $row['house_ownership']; ?></td>
            <td><?php echo $row['light_source']; ?></td>
            <td><?php echo $row['water_source']; ?></td>
            <td><?php echo $row['pets']; ?></td>
            <td><?php echo $row['beneficiaries']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // Sample data (replace with the actual data from PHP)
    const residents = <?php echo json_encode($residents); ?>;

    function filterResidents() {
        const lastNameFilter = document.getElementById('last_name').value.toLowerCase();
        const firstNameFilter = document.getElementById('first_name').value.toLowerCase();
        const extensionNameFilter = document.getElementById('extension_name').value.toLowerCase();
        const middleNameFilter = document.getElementById('middle_name').value.toLowerCase();
        const birthdayFilter = document.getElementById('birthday').value;
        const ageFilter = document.getElementById('age').value;
        const maritalStatusFilter = document.getElementById('marital_status').value;
        const purokFilter = document.getElementById('purok').value.toLowerCase();
        const sourceOfIncomeFilter = document.getElementById('source_of_income').value.toLowerCase();
        const houseOwnershipFilter = document.getElementById('house_ownership').value;
        const lightSourceFilter = document.getElementById('light_source').value;
        const waterSourceFilter = document.getElementById('water_source').value;
        const petsFilter = document.getElementById('pets').value.toLowerCase();
        const beneficiariesFilter = document.getElementById('beneficiaries').value;

        // Clear the current table body
        const residentsBody = document.getElementById('residentsBody');
        residentsBody.innerHTML = '';

        // Filter the residents array
        const filteredResidents = residents.filter(resident => {
            return (
                (lastNameFilter === '' || resident.last_name.toLowerCase().includes(lastNameFilter)) &&
                (firstNameFilter === '' || resident.first_name.toLowerCase().includes(firstNameFilter)) &&
                (extensionNameFilter === '' || resident.extension_name.toLowerCase().includes(extensionNameFilter)) &&
                (middleNameFilter === '' || resident.middle_name.toLowerCase().includes(middleNameFilter)) &&
                (birthdayFilter === '' || resident.birthday === birthdayFilter) &&
                (ageFilter === '' || resident.age == ageFilter) &&
                (maritalStatusFilter === '' || resident.marital_status === maritalStatusFilter) &&
                (purokFilter === '' || resident.purok.toLowerCase() === purokFilter) &&
                (sourceOfIncomeFilter === '' || resident.source_of_income.toLowerCase().includes(sourceOfIncomeFilter)) &&
                (houseOwnershipFilter === '' || resident.house_ownership === houseOwnershipFilter) &&
                (lightSourceFilter === '' || resident.light_source === lightSourceFilter) &&
                (waterSourceFilter === '' || resident.water_source === waterSourceFilter) &&
                (petsFilter === '' || resident.pets.toLowerCase().includes(petsFilter)) &&
                (beneficiariesFilter === '' || resident.beneficiaries === beneficiariesFilter)
            );
        });

        // Display the filtered residents
        filteredResidents.forEach(resident => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${resident.last_name}</td>
                <td>${resident.first_name}</td>
                <td>${resident.middle_name}</td>
                <td>${resident.extension_name}</td>
                <td>${resident.birthday}</td>
                <td>${resident.age}</td>
                <td>${resident.marital_status}</td>
                <td>${resident.purok}</td>
                <td>${resident.source_of_income}</td>
                <td>${resident.house_ownership}</td>
                <td>${resident.light_source}</td>
                <td>${resident.water_source}</td>
                <td>${resident.pets}</td>
                <td>${resident.beneficiaries}</td>
            `;
            residentsBody.appendChild(row);
        });
    }
</script>
</body>
</html>
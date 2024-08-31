<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resident - Secretary Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css">
     <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <div class="title">
            <h1>Secretary</h1>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="../home.php" class="nav-link">Home</a></li>
                <li><a href="../files/index.php" class="nav-link">Files</a></li>
                <li><a href="index.php" class="nav-link">Residents</a></li>
                <li><a href="../report/index.php" class="nav-link">Report</a></li>
                <li><a href="../seminar/index.php" class="nav-link">Seminar</a></li>
                <li><a href="../government/index.php" class="nav-link">Government</a></li>
                <li><a href="../beneficiaries/index.php" class="nav-link">Beneficiaries</a></li>
                <li><a href="../logout.php" class="nav-link logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>
     <main>
        <h2>Create Resident Record</h2>
        <form action="process_create.php" method="POST" class="resident-form">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name">

            <label for="extension_name">Extension Name:</label>
            <input type="text" id="extension_name" name="extension_name">

            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required onchange="calculateAge()">

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" readonly>

            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status" onchange="handleMaritalStatus()" required>
                <option value="">Select...</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Lived in Partner">Lived in Partner</option>
                <option value="Widower/Widow">Widower/Widow</option>
                <option value="Single Parent">Single Parent</option>
            </select>

            <div id="partner_info" style="display:none;">
                <label for="partner_name">Partner Name:</label>
                <input type="text" id="partner_name" name="partner_name">

                <label for="children_count">Number of Children:</label>
                <input type="number" id="children_count" name="children_count">
            </div>

            <label for="purok">Purok:</label>
            <input type="text" id="purok" name="purok" required>

            <label for="source_of_income">Source of Income:</label>
            <select id="source_of_income" name="source_of_income" onchange="handleSourceOfIncome()" required>
                <option value="">Select...</option>
                <option value="None">None</option>
                <option value="Private">Private</option>
                <option value="Government">Government</option>
                <option value="Driver">Driver</option>
                <option value="Business">Business</option>
            </select>

            <div id="private_info" style="display:none;">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name">
            </div>

            <div id="government_info" style="display:none;">
                <label for="government_work">Government Work:</label>
                <input type="text" id="government_work" name="government_work">
            </div>

            <div id="driver_info" style="display:none;">
                <label for="vehicle_type">Type of Vehicle:</label>
                <input type="text" id="vehicle_type" name="vehicle_type">
            </div>

            <div id="business_info" style="display:none;">
                <label for="business_type">Type of Business:</label>
                <input type="text" id="business_type" name="business_type">
            </div>

            <label for="house_ownership">House Ownership:</label>
            <select id="house_ownership" name="house_ownership" required>
                <option value="Own">Own</option>
                <option value="Rent">Rent</option>
            </select>

            <label for="light_source">Light Source:</label>
            <select id="light_source" name="light_source" required>
                <option value="MECO">MECO</option>
                <option value="Solar">Solar</option>
                <option value="Gas Lamp">Gas Lamp</option>
            </select>

            <label for="water_source">Water Source:</label>
            <select id="water_source" name="water_source" required>
                <option value="Deep well">Deep well</option>
                <option value="Puso">Puso</option>
                <option value="MCWD">MCWD</option>
            </select>

            <label for="pets">Pets:</label>
            <input type="text" id="pets" name="pets">

            <label for="beneficiaries">Beneficiaries:</label>
            <input type="text" id="beneficiaries" name="beneficiaries">

            <input type="submit" value="Create Record">
        </form>
    </main>
    <script src="index.js"></script>
</body>
</html>

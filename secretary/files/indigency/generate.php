    <?php
    // Database connection
    $servername = "localhost"; // Update with your server details
    $username = "root"; // Update with your database username
    $password = ""; // Update with your database password
    $dbname = "gabi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the latest certificate data
    $sql = "SELECT * FROM indigency ORDER BY id DESC LIMIT 1"; // Get the most recent entry
    $result = $conn->query($sql);
    $resident = $result->fetch_assoc();

    $conn->close();
    ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Certificate of Indigency</title>
    <style>
        body {
            margin: 0; /* Remove default body margin */
            padding: 0; /* Remove default body padding */
            display: flex;
            flex-direction: column; /* Align items vertically */
            align-items: center; /* Center items horizontally */
            height: 100vh;
            background-color: gray;
        }

        .print-button {
            margin-top: 10px; /* Space above the button */
            align-self: flex-start; /* Align button to the top left */
            padding: 10px 20px; /* Button padding */
            font-size: 14pt; /* Button font size */
            cursor: pointer; /* Cursor change on hover */
        }

        .certificate {
            width: 100%; /* Use full width of the container */
            max-width: 8.5in; /* Maximum width for short bond paper */
            height: auto; /* Automatic height to maintain aspect ratio */
            padding: 1in; /* 1-inch padding */
            border: 1px solid black; /* Border around the certificate */
            box-sizing: border-box;
            position: relative;
            background-color: white; /* Ensure white background for printing */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            text-align: center;
            color: black;
            position: relative;
            margin: 0; /* Remove header margin */
            padding: 0; /* Remove top padding from header */
        }

        .header img {
            width: 120px; /* Adjust the size as needed */
            position: absolute;
            top: 0;
        }

        .header .left-image {
            left: 0;
        }

        .header .right-image {
            right: 0;
        }

        .header h2 {
            margin: 0; /* Remove heading margin */
            padding: 0; /* Remove heading padding */
            line-height: 1; /* Set line height to minimize gaps */
        }

        .barangay-title {
            font-family: Rockwell Extra Bold, Rockwell Bold, monospace;
            color: green;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0; /* Adjust margin as needed */
        }

        .certificate-title {
            font-family: Arial, sans-serif;
            font-size: 18pt;
            color: blue;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }

        .body-text {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            text-align: justify;
            margin: 20px 0;
            line-height: 1.5;
        }

        .issued-date {
            text-align: center;
            margin-top: 30px;
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }

        .signature {
            display: flex; /* Use flexbox for signature section */
            flex-direction: column; /* Stack items vertically */
            align-items: right; /* Center items horizontally */
            margin-top: 60px; /* Margin above the signature */
            font-size: 12pt;
        }

        .signature p {
            margin: 0; /* Remove paragraph margin */
            text-align: right; /* Center the text */
        }

        .signature .punong-barangay {
            font-size: 14pt; /* Increase font size for emphasis */
        }

        .payment-info {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            text-align: left;
            margin-top: 50px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        @media print {
            @page {
                size: 8.5in 11in; /* Short bond paper size */
                margin: 0; /* Remove margins for printing */
            }
            body {
                margin: 0; /* Remove body margins */
            }
            .certificate {
                border: none; /* Remove border for printing */
                box-shadow: none; /* Remove box shadow */
            }
            .print-button {
                display: none; /* Hide the button when printing */
            }
        }
    </style>
    <script>
        function printCertificate() {
            window.print();
        }
         function printCertificate() {
            window.print();
            // Redirect to create.php after a short delay
            setTimeout(function() {
                window.location.href = 'create.php';
            }, 1000); // 1 second delay before redirecting
        }
    </script>
</head>
<body>
    <button class="print-button" onclick="printCertificate()">Print Certificate</button>
    <div class="certificate">
        <div class="header">
            <img src="../../../wew.png" alt="Left Image" class="left-image">
            <img src="../../../bp.png" alt="Right Image" class="right-image">
            <h2 style="font-size: 15pt;">Republic of the Philippines</h2>
            <h2 style="font-size: 14pt;">Province of Cebu</h2>
            <h2 style="font-size: 14pt;">Municipality of Cordova</h2>
            <br>
        <br>
        
            <h2 class="barangay-title">B A R A N G A Y    G A B I</h2>
        </div>
           <br>
              <br>
        <div style="border-top: 1px solid black; margin: 10px 0;"></div>
        <br>
        <div class="certificate-title">
            CERTIFICATE OF INDIGENCY
        </div>

        <div class="body-text">
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp This is to certify that <strong><?php echo htmlspecialchars($resident['name']); ?></strong> is a bonafide resident of <strong><?php echo htmlspecialchars($resident['purok']); ?></strong>, Gabi, Cordova, Cebu, for a period of <strong><?php echo htmlspecialchars($resident['year_living']); ?></strong> years, personally known to me as an INDIGENT individual whose income is insufficient for the family’s subsistence.
        </div>

        <div class="body-text">
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp This certification is issued upon the request of <strong><?php echo htmlspecialchars($resident['name']); ?></strong> for <strong><?php echo htmlspecialchars($resident['purpose']); ?></strong> purpose it may serve best.
        </div>

        <div class="issued-date">
            Issued this <strong><?php echo date('d', strtotime($resident['date_issued'])); ?></strong> day of <strong><?php echo date('F', strtotime($resident['date_issued'])); ?></strong>, <strong><?php echo date('Y', strtotime($resident['date_issued'])); ?></strong> at Gabi, Cordova, Cebu.
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="signature">
            <p>HON. NICOLAS C. ANTIPUESTO</p>
            <p class="punong-barangay">Punong Barangay</p>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        <div class="payment-info">
            Paid Under Receipt No._______<br>
            Amount:________<br>
            Date:___________<br>
            CTC NO:______________<br>
            Issued on:_____________<br>
            Issued at:______________
        </div>
    </div>
</body>
</html>

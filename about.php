<?php
// about.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About - Blind People's Association</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1, h2 {
            color: #2c3e50;
        }
        .highlight {
            color: #e74c3c; /* red highlight for emphasis */
        }
        .info-box {
            background: #f9f9f9;
            border-left: 5px solid #3498db;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        th {
            background: #3498db;
            color: #fff;
        }
        .contact {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>About <span class="highlight">Blind People's Association (BPA)</span>, Ahmedabad</h1>

    <div class="info-box">
        <p>
            The <b>Blind People’s Association (BPA)</b> in Ahmedabad is a leading NGO working since <b>1950</b> 
            for the empowerment of persons with disabilities (PwDs), especially the visually impaired. 
            Their mission covers education, rehabilitation, training, healthcare, and social inclusion.
        </p>
    </div>

    <h2>Services & Initiatives</h2>
    <ul>
        <li><b>Education & Training</b> – Free residential schools up to 12th grade, B.Ed, ITI, and skill-based training.</li>
        <li><b>Inclusive Education</b> – Supporting 2,000+ students in mainstream schools.</li>
        <li><b>Rehabilitation & Healthcare</b> – Assistive devices, therapy, and a multi-specialty hospital complex.</li>
        <li><b>Digital Education</b> – First in India to digitize curriculum for classes 6–9.</li>
        <li><b>Awareness Programs</b> – Car rallies guided by blind participants and the “Vision-in-the-Dark” exhibition.</li>
    </ul>

    <h2>Summary</h2>
    <table>
        <tr><th>Feature</th><th>Details</th></tr>
        <tr><td>Founded</td><td>1950 by Jagdish Patel</td></tr>
        <tr><td>Core Services</td><td>Education, rehab, training, assistive devices</td></tr>
        <tr><td>Inclusive Education</td><td>Resource support in mainstream schools</td></tr>
        <tr><td>Special Events</td><td>Car rally, Vision-in-the-Dark exhibition</td></tr>
        <tr><td>Future Plans</td><td>BPA International Rehabilitation University</td></tr>
        <tr><td>Location</td><td>Vastrapur, Ahmedabad</td></tr>
    </table>

    <h2>Contact</h2>
    <div class="contact">
        <p><b>Address:</b> 132 Feet Ring Road, Vastrapur, Opp. IIM Campus, Jagdish Patel Chowk, Ahmedabad – 380015</p>
        <p><b>Phone:</b> 079–26304070 / 26300176</p>
        <p><b>Website:</b> <a href="https://bpaindia.org" target="_blank">www.bpaindia.org</a></p>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

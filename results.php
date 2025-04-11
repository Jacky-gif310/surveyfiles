<?php
// results.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Database connection settings.
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "survey_db";

// Create connection.
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get distinct platforms from the feedback table.
$platforms = [];
$sqlPlatforms = "SELECT DISTINCT shopping_platform FROM customer_feedback ORDER BY shopping_platform ASC";
$resultPlatforms = $conn->query($sqlPlatforms);
if ($resultPlatforms && $resultPlatforms->num_rows > 0) {
    while ($row = $resultPlatforms->fetch_assoc()) {
        $platforms[] = $row['shopping_platform'];
    }
}

// Helper function to retrieve chart data for a given platform and survey column.
function getChartData($conn, $platform, $column, $order = "") {
    $sql = "SELECT $column, COUNT(*) as count FROM customer_feedback 
            WHERE shopping_platform = '$platform' 
            GROUP BY $column";
    if($order !== "") {
        $sql .= " ORDER BY $order";
    }
    $result = $conn->query($sql);
    $labels = [];
    $counts = [];
    if ($result && $result->num_rows > 0) {
        while($r = $result->fetch_assoc()){
            $labels[] = $r[$column];
            $counts[] = $r['count'];
        }
    }
    return ['labels' => json_encode($labels), 'counts' => json_encode($counts)];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey Results Grouped by Platform | Survey Analysis Tool</title>
  <link rel="stylesheet" href="styles.css">
  <!-- Include Chart.js from CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #3498db;
      color: #fff;
      padding: 1em;
    }
    header nav ul {
      list-style: none;
      display: flex;
      justify-content: center;
      margin: 0;
      padding: 0;
    }
    header nav li {
      margin: 0 1em;
    }
    header nav a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
    }
    .results {
      max-width: 900px;
      margin: 2em auto;
      padding: 1em 2em;
      background: #fff;
      border-radius: 6px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .platform-container {
      margin-bottom: 2em;
      padding: 1em;
      border: 1px solid #ddd;
      border-radius: 6px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .platform-header {
      display: flex;
      align-items: center;
      margin-bottom: 1em;
    }
    .platform-logo {
      width: 50px;
      height: auto;
      margin-right: 1em;
    }
    .chart-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 1em;
      justify-content: center;
    }
    .chart-item {
      flex: 1 1 280px;
      max-width: 280px;
      background: #fff;
      padding: 1em;
      border: 1px solid #eaeaea;
      border-radius: 4px;
      text-align: center;
    }
    .chart-item canvas {
      width: 100% !important;
      height: 200px !important;
    }
    footer {
      text-align: center;
      padding: 1em;
      background-color: #3498db;
      color: #fff;
      margin-top: 2em;
    }
  </style>
</head>
<body>
<header>
  <nav>
    <h1>Survey Analysis Tool</h1>
    <ul>
      <li><a href="Form.php">Home</a></li>
      <li><a href="survey.php">Survey</a></li>
      <li><a href="results.php">Results</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>
</header>
<section class="results">
  <h2>Survey Results Grouped by Platform</h2>

  <?php 
  foreach ($platforms as $index => $platform) { 
      $pLower = strtolower($platform);
      $logo = ""; // Variable to hold logo image path.

      // Assign specific logos for known platforms.
      if ($pLower == "jumia") {
          $logo = "jumia.png";
      } elseif ($pLower == "amazon") {
          $logo = "amazon.png";
      } elseif ($pLower == "kilimall") {
          $logo = "kilimal.png";
      } elseif ($pLower == "carrefour") {
          $logo = "carrefour.png";
      }
      
      // If the platform doesn't match any known platforms, skip it.
      if (!$logo) {
          continue; // Skip processing this platform if no logo found.
      }

      // Retrieve chart data for this platform.
      $experience = getChartData($conn, $platform, "experience_rating", "experience_rating");
      $product    = getChartData($conn, $platform, "product_satisfaction");
      $delivery   = getChartData($conn, $platform, "delivery_rating", "delivery_rating");
      $recommend  = getChartData($conn, $platform, "recommendation");
      $frequency  = getChartData($conn, $platform, "shopping_frequency");
      $pricing    = getChartData($conn, $platform, "pricing_fairness");
      $support    = getChartData($conn, $platform, "support_rating", "support_rating");
      $speed      = getChartData($conn, $platform, "delivery_speed");
  ?>
    <div class="platform-container">
      <div class="platform-header">
        <img src="<?php echo $logo; ?>" alt="<?php echo $platform; ?> Logo" class="platform-logo">
        <h3><?php echo $platform; ?></h3>
      </div>
      <div class="chart-grid">
        <!-- Experience Rating Chart (Bar Chart) -->
        <div class="chart-item">
          <canvas id="experienceChart_<?php echo $index; ?>"></canvas>
          <p>Shopping Experience Rating</p>
        </div>
        <!-- Product Satisfaction Chart (Pie Chart) -->
        <div class="chart-item">
          <canvas id="productChart_<?php echo $index; ?>"></canvas>
          <p>Product Satisfaction</p>
        </div>
        <!-- Delivery Experience Chart (Bar Chart) -->
        <div class="chart-item">
          <canvas id="deliveryChart_<?php echo $index; ?>"></canvas>
          <p>Delivery Experience Rating</p>
        </div>
        <!-- Recommendation Chart (Doughnut Chart) -->
        <div class="chart-item">
          <canvas id="recommendationChart_<?php echo $index; ?>"></canvas>
          <p>Would Recommend?</p>
        </div>
        <!-- Shopping Frequency Chart (Bar Chart) -->
        <div class="chart-item">
          <canvas id="frequencyChart_<?php echo $index; ?>"></canvas>
          <p>Shopping Frequency</p>
        </div>
        <!-- Pricing Fairness Chart (Doughnut Chart) -->
        <div class="chart-item">
          <canvas id="pricingChart_<?php echo $index; ?>"></canvas>
          <p>Pricing Fairness</p>
        </div>
        <!-- Customer Support Rating Chart (Bar Chart) -->
        <div class="chart-item">
          <canvas id="supportChart_<?php echo $index; ?>"></canvas>
          <p>Customer Support Rating</p>
        </div>
        <!-- Delivery Speed Chart (Pie Chart) -->
        <div class="chart-item">
          <canvas id="speedChart_<?php echo $index; ?>"></canvas>
          <p>Delivery Speed</p>
        </div>
      </div>
    </div>
    
    <script>
      // For platform: <?php echo $platform; ?>

      // Experience Rating Chart (Bar.)
      var ctxExp_<?php echo $index; ?> = document.getElementById('experienceChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxExp_<?php echo $index; ?>, {
         type: 'bar',
         data: {
            labels: <?php echo $experience['labels']; ?>,
            datasets: [{
              label: 'Responses',
              data: <?php echo $experience['counts']; ?>,
              backgroundColor: 'rgba(52, 152, 219, 0.6)',
              borderColor: 'rgba(41, 128, 185, 1)',
              borderWidth: 1
            }]
         },
         options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
         }
      });

      // Product Satisfaction Chart (Pie)
      var ctxProd_<?php echo $index; ?> = document.getElementById('productChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxProd_<?php echo $index; ?>, {
         type: 'pie',
         data: {
            labels: <?php echo $product['labels']; ?>,
            datasets: [{
              label: 'Product Satisfaction',
              data: <?php echo $product['counts']; ?>,
              backgroundColor: ['#e74c3c', '#2ecc71', '#f39c12', '#3498db']
            }]
         },
         options: {
            responsive: true
         }
      });

      // Delivery Experience Chart (Bar)
      var ctxDel_<?php echo $index; ?> = document.getElementById('deliveryChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxDel_<?php echo $index; ?>, {
         type: 'bar',
         data: {
            labels: <?php echo $delivery['labels']; ?>,
            datasets: [{
              label: 'Delivery Experience',
              data: <?php echo $delivery['counts']; ?>,
              backgroundColor: 'rgba(231, 76, 60, 0.6)',
              borderColor: 'rgba(192, 57, 43, 1)',
              borderWidth: 1
            }]
         },
         options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
         }
      });

      // Recommendation Chart (Doughnut)
      var ctxRec_<?php echo $index; ?> = document.getElementById('recommendationChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxRec_<?php echo $index; ?>, {
         type: 'doughnut',
         data: {
            labels: <?php echo $recommend['labels']; ?>,
            datasets: [{
              label: 'Would Recommend?',
              data: <?php echo $recommend['counts']; ?>,
              backgroundColor: ['#16a085', '#f39c12']
            }]
         },
         options: {
            responsive: true
         }
      });

      // Shopping Frequency Chart (Bar)
      var ctxFreq_<?php echo $index; ?> = document.getElementById('frequencyChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxFreq_<?php echo $index; ?>, {
         type: 'bar',
         data: {
            labels: <?php echo $frequency['labels']; ?>,
            datasets: [{
              label: 'Shopping Frequency',
              data: <?php echo $frequency['counts']; ?>,
              backgroundColor: 'rgba(52, 152, 219, 0.6)',
              borderColor: 'rgba(41, 128, 185, 1)',
              borderWidth: 1
            }]
         },
         options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
         }
      });

      // Pricing Fairness Chart (Doughnut)
      var ctxPrice_<?php echo $index; ?> = document.getElementById('pricingChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxPrice_<?php echo $index; ?>, {
         type: 'doughnut',
         data: {
            labels: <?php echo $pricing['labels']; ?>,
            datasets: [{
              label: 'Pricing Fairness',
              data: <?php echo $pricing['counts']; ?>,
              backgroundColor: ['#16a085', '#e74c3c']
            }]
         },
         options: {
            responsive: true
         }
      });

      // Support Rating Chart (Bar)
      var ctxSupp_<?php echo $index; ?> = document.getElementById('supportChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxSupp_<?php echo $index; ?>, {
         type: 'bar',
         data: {
            labels: <?php echo $support['labels']; ?>,
            datasets: [{
              label: 'Customer Support Rating',
              data: <?php echo $support['counts']; ?>,
              backgroundColor: 'rgba(231, 76, 60, 0.6)',
              borderColor: 'rgba(192, 57, 43, 1)',
              borderWidth: 1
            }]
         },
         options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
         }
      });

      // Delivery Speed Chart (Pie)
      var ctxSpeed_<?php echo $index; ?> = document.getElementById('speedChart_<?php echo $index; ?>').getContext('2d');
      new Chart(ctxSpeed_<?php echo $index; ?>, {
         type: 'pie',
         data: {
            labels: <?php echo $speed['labels']; ?>,
            datasets: [{
              label: 'Delivery Speed',
              data: <?php echo $speed['counts']; ?>,
              backgroundColor: ['#2ecc71', '#f39c12', '#e74c3c']
            }]
         },
         options: {
            responsive: true
         }
      });
    </script>
  <?php } ?>
</section>
<footer>
  <p>&copy; 2025 Survey Analysis Tool. All rights reserved.</p>
</footer>
</body>
</html> 
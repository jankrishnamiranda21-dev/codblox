<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Employee Performance Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>🧍‍♂️ Employee Performance Tracker</h2>

<!-- Add Employee Form -->
<form method="POST" action="insert.php">
  <input type="text" name="name" placeholder="Employee Name" required>
  <input type="text" name="department" placeholder="Department" required>
  <input type="number" step="0.01" name="performance" placeholder="Performance Score" required>
  <button type="submit">Add Employee</button>
</form>

<!-- Employee Table -->
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Department</th>
    <th>Performance</th>
    <th>Action</th>
  </tr>

  <?php
  $result = $conn->query("SELECT * FROM employees");
  while ($row = $result->fetch_assoc()):
  ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['department'] ?></td>
    <td><?= $row['performance'] ?></td>
    <td><a href="delete.php?id=<?= $row['id'] ?>" class="btn">Delete</a></td>
  </tr>
  <?php endwhile; ?>
</table>

<!-- Subquery 1: Top Performer -->
<div class="subquery-section">
  <h3>🏆 Top Performer (SQL Subquery)</h3>
  <?php
  $top = $conn->query("SELECT name, performance FROM employees WHERE performance = (SELECT MAX(performance) FROM employees)");
  if ($t = $top->fetch_assoc()) {
    echo "<p><strong>{$t['name']}</strong> is the Top Performer with a score of <b>{$t['performance']}</b>.</p>";
  }
  ?>
</div>

<!-- Subquery 2: Above Average -->
<div class="subquery-section">
  <h3>📊 Above Average Employees (SQL Subquery)</h3>
  <table>
    <tr><th>Name</th><th>Department</th><th>Performance</th></tr>
    <?php
    $above = $conn->query("SELECT name, department, performance FROM employees WHERE performance > (SELECT AVG(performance) FROM employees)");
    while ($a = $above->fetch_assoc()):
    ?>
    <tr>
      <td><?= $a['name'] ?></td>
      <td><?= $a['department'] ?></td>
      <td><?= $a['performance'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

</body>
</html>

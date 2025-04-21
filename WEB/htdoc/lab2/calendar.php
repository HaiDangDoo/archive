<!-- Lê Hải Đăng - B2203716 -->

<!DOCTYPE html>
<html>
<head>
    <title>Simple Calendar</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Simple Calendar</h1>

<?php
// Lấy tháng & năm từ URL, nếu không có thì dùng giá trị mặc định
$currentMonth = isset($_GET['month']) ? $_GET['month'] : date('n') - 1;
$currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
?>

<form method="get" action="calendar.php">
    <label for="month">Month:</label>
    <select name="month" id="month">
        <?php
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        foreach ($months as $index => $month) {
            $selected = ($index == $currentMonth) ? 'selected' : '';
            echo "<option value=\"$index\" $selected>$month</option>";
        }
        ?>
    </select>

    <label for="year">Year:</label>
    <select name="year" id="year">
        <?php
        for ($year = date('Y') - 10; $year <= date('Y') + 10; $year++) {
            $selected = ($year == $currentYear) ? 'selected' : '';
            echo "<option value=\"$year\" $selected>$year</option>";
        }
        ?>
    </select>

    <button type="submit">Go!</button>
</form>

<?php
// Kiểm tra xem có tháng và năm được chọn không
if (isset($_GET['month'], $_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];

    // Lấy ngày đầu tiên của tháng (0 = Chủ Nhật, 6 = Thứ Bảy)
    $firstDay = date('w', mktime(0, 0, 0, $month + 1, 1, $year));
    // Số ngày trong tháng
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month + 1, $year);

    echo "<h2>{$months[$month]} $year</h2>";
    echo "<table>";
    echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

    $dayCounter = 1;
    echo "<tr>";

    // In ô trống trước ngày 1
    for ($i = 0; $i < $firstDay; $i++) {
        echo "<td></td>";
    }

    // In các ngày trong tháng
    for ($i = $firstDay; $i < 7; $i++) {
        echo "<td>$dayCounter</td>";
        $dayCounter++;
    }
    echo "</tr>";

    // In các tuần tiếp theo
    while ($dayCounter <= $daysInMonth) {
        echo "<tr>";
        for ($i = 0; $i < 7; $i++) {
            if ($dayCounter <= $daysInMonth) {
                echo "<td>$dayCounter</td>";
                $dayCounter++;
            } else {
                echo "<td></td>"; // Ô trống cuối tháng
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

</body>
</html>

<?php
$scores = [60, 70, 80, 90, 75];

// Average
$avg = array_sum($scores) / count($scores);

// Max & Min
$max = max($scores);
$min = min($scores);

// Scores greater than average
$top = [];
foreach ($scores as $s) {
    if ($s > $avg) {
        $top[] = $s;
    }
}

echo "Avg: " . round($avg, 1) . ", ";
echo "Top: [" . implode(", ", $top) . "]";
?>

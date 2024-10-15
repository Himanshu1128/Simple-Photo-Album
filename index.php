<?php
$images = array_values(array_filter(scandir('images'), function($file) {
    return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'png', 'jpeg', 'gif']);
}));

$totalImages = count($images);
$index = isset($_GET['index']) ? (int)$_GET['index'] : 0;
$index = max(0, min($index, $totalImages - 4));

$leftImage = null;
$rightImage = null;
$nextImage1 = null;
$nextImage2 = null;

if ($totalImages > 0) {
    $leftImage = $images[$index] ?? null;
    $rightImage = $images[$index + 1] ?? null;
    $nextImage1 = $images[$index + 2] ?? null;
    $nextImage2 = $images[$index + 3] ?? null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Album Task</title>
</head>
<body>
    <div class="album">
        <div id="left-side" class="page">
            <?php if ($leftImage): ?>
                <img src="images/<?php echo $leftImage; ?>" alt="">
            <?php endif; ?>
        </div>
        <div id="right-side" class="page">
            <?php if ($rightImage): ?>
                <img src="images/<?php echo $rightImage; ?>" alt="">
            <?php endif; ?>
        </div>
    </div>
    <div class="buttons">
        <div class="buttons-container">
            <a href="?index=0"><button id="button">&lt;&lt;</button></a>
            <a href="?index=<?php echo max(0, $index - 2); ?>" onclick="flipPage(-1); return false;"><button id="button">&lt;</button></a>
            <div>
                <img src="images/<?php echo $nextImage1; ?>" alt="">
            </div>
            <div>
                <img src="images/<?php echo $nextImage2; ?>" alt="">
            </div>
            <a href="?index=<?php echo min($totalImages - 2, $index + 2); ?>" onclick="flipPage(1); return false;"><button id="button">&gt;</button></a>
            <a href="?index=<?php echo $totalImages - 4; ?>"><button id="button">&gt;&gt;</button></a>
        </div>
    </div>
    
    <script>
        function flipPage(direction) {
            const leftSide = document.getElementById('left-side');
            const rightSide = document.getElementById('right-side');
            leftSide.classList.add('flip-left');
            rightSide.classList.add('flip-right');
            
            setTimeout(() => {
                window.location.href = direction > 0 ? `?index=<?php echo min($totalImages - 2, $index + 2); ?>` : `?index=<?php echo max(0, $index - 2); ?>`;
            }, 500);
        }
    </script>
</body>
</html>

<?php

function showPercentage($name, $value) {
    $name = ucfirst(trim($name));

    $value = ($value >= 100) ? 100 : $value;
    $value = ($value <= 0) ? 0 : $value;

    if ($value <= 20) {
        $text = 'Inutil';
    } elseif ($value <= 40) {
        $text = 'Malo';
    } elseif ($value <= 60) {
        $text = 'Normal';
    } elseif ($value <= 80) {
        $text = 'Bueno';
    } elseif ($value <= 100) {
        $text = 'Excelente';
    } else {
        $text = 'Legendario';
    }
?>
    <div class="percentageBox"><?php echo $name; ?>
        <div class="percentage">
            <div class="levelBar" style="width: <?php echo $value ?>%"><?php echo $text ?></div>
        </div>
    </div>
<?php }

 ?>
<div id="playerCharacter">
<div>
    <h2> <?php echo $description['name'] ?></h2>
</div>
<?php
foreach ($description['attributes'] as $attribute => $value) {
    showPercentage($attribute, $value);
}
?>
</div>
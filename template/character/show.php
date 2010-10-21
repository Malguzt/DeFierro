<?php foreach ($description as $key => $value){ ?>
<div>
    <?php if(is_array($value)){
        foreach ($value as $attribute => $number) {?>
    <p><?php echo $attribute.': '.$number?></p>
    <?php }
    } else { ?>
    <p><?php echo $key.': '.$value ?></p>
    <?php } ?>
</div>
<?php } ?>
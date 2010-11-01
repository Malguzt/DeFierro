<?php

abstract class View {

    /**
     *  Generate percentage box of attribute.
     * @author Lenscak José Francisco [Malguzt]
     * @param string $name
     * @param string $value
     * @return html
     */
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

        $html = "<div class='percentageBox'>$name
            <div class='percentage'>
                <div class='levelBar' style='width: $value%'>$text</div>
            </div>
        </div>";
        
        return $html;
    }

}
?>

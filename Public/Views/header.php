<?php 
function header_with_title($title) {
    return <<<HTML
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{$title}</title>
    </head>
HTML;
}
?>
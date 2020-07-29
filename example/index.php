<?php

include "../vendor/autoload.php";

$compiler = new TemplateComponents\Compiler(
    new TemplateComponents\Component( 'subtitle', '<h2>{{ slot }}</h2>' ),
    new TemplateComponents\Component( 'contents', '<div>Before ... {{ slot }} ... after</div></div>' )
);

ob_start();
include 'template.html.php';
$template = ob_get_clean();

echo $compiler->compile(
    $template
) . PHP_EOL;
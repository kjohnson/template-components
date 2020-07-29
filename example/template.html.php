<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Template Components</h1>

    <x-subtitle>
        Subtitle
    </x-subtitle>

    <x-contents>Contens component</x-contents>

    <?php if( false ): ?>
        <x-contents>Not visibile</x-contents>
    <?php endif; ?>

</body>
</html>
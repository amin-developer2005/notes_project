<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $heading ?></title>

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>
<body class="bg-black text-white">

<div class="px-15 pb-20">

    <?php require base_path('App/View/partials/nav.php') ?>



    <main class="mt-13 max-w-[986px] mx-auto">
        <?php
            echo $content;
        ?>
    </main>
</div>
</body>
</html>

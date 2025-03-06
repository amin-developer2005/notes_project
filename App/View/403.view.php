<?php
use Core\Url;
?>

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold">
            You are not authorized to view this page or perform this action.
         </h1>

        <p class="mt-4">
            <a href="<?= Url::load('/home') ?>" class="text-blue-500 underline">Go back home.</a>
        </p>
    </div>


<?php
use Core\Url;

$btnClasses = "shadow-sm bg-blue-700 text-white font-semibold border-transparent hover:bg-blue-500 focus:bg-green-800 dark:focus:bg-blue-900 rounded-md border border-transparent px-6 py-3 transition-colors ease-in-out tracking-widest duration-200 cursor-pointer tracking-widest focus:ring-3 focus:ring-indigo-500 focus:ring-offset-2";

?>
<div class="max-w-7xl py-20 space-y-9 sm:px-6 lg:px-8">

<div class="max-w-7xl sm:px-6 lg:px-9 flex md:py-18 p-10-center bg-white/15 hover:bg-white/10 rounded-xl border border-transparent hover:border-blue-700 transition-colors duration-300 group cursor-pointer">

    <div class="flex-1 flex-col items-center justify-stretch">
        <div class="pb-9">
            <span class="text-3xl font-bold text-white group-hover:text-blue-600 font-bold"><?= $note->title ?></span>
        </div>

        <p class="text-l text-white"><?= $note->body ?></p>
    </div>


    <div class="gap-x-4 flex items-center md:mb-35">
        <a href="<?= Url::load('/note/edit?id=') . $note->id ?>" class="<?= $btnClasses ?>">Edit</a>

        <form method="POST" action="<?= Url::load('/note/delete') ?>" class="inline-block">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note->id ?>">
            <button type="submit" class="<?= $btnClasses ?>">Delete</button>
        </form>
    </div>


</div>
</div>

<?php
use Core\Url;
$submitClasses = "shadow-sm w-full my-7 bg-blue-700 text-white font-semibold border-transparent hover:bg-blue-500 focus:bg-green-800 dark:focus:bg-blue-900 rounded-md border border-transparent px-6 py-3 transition-colors ease-in-out tracking-widest duration-200 cursor-pointer tracking-widest focus:ring-3 focus:ring-indigo-500 focus:ring-offset-2";
$inputClasses = "rounded-md border border-2 border-gray-300 hover:border-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 w-full transition-colors duration-400 ease-in-out sm:text-l px-4 py-3";


?>


<div class="py-3 sm:pb-11">
    <h1 class="text-3xl">Create New Note</h1>
</div>


<div class=" flex items-center justify-center">

    <div class="mx-auto max-w-4xl w-full">
        <div class="md:grid md:grid-cols-1">
            <div class="mt-3 md:col-span-2 md:mt-0">
                <form method="POST" action="<?= Url::load('/notes/store') ?>">
                    <div class="shadow sm:overflow-hidden sm:rounded-md text-white px-11 sm:px-10 sm:p-4">

                        <div class="space-y-13">
                            <div>
                                <label for="title" class=" font-medium block text-xl">Title</label>

                                <div class="mt-4">
                                    <input type="text"
                                           name="title"
                                           id="title"
                                           class="<?= $inputClasses ?> h-10"
                                           placeholder="Enter title"
                                           value="<?= Url::hasPost('title') ? Url::fetchPost('title') : '' ?>"
                                           required>
                                    <?php if (isset($errors['title'])) { ?>
                                        <div class="sm:py-4">
                                            <p class="text-red-500 text-s font-bold"><?= $errors['title'] ?></p>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>

                            <div>
                                <label
                                        for="body"
                                        class="block text-xl font-medium">Body</label>
                                <div class="mt-4">
                                    <textarea
                                            id="body"
                                            name="body"
                                            rows="8"
                                            class="<?= $inputClasses ?>"
                                            placeholder="Enter the note body here"
                                    required><?= Url::hasPost('body') ? Url::fetchPost('body') : '' ?></textarea>

                                    <?php if (isset($errors['body'])) { ?>
                                        <p class="text-red-500 text-s"><?= $errors['body'] ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="inline-flex sm:py-3 pt-8 sm:pt-17 w-full">
                            <button
                                    type="submit"
                                    class="<?= $submitClasses ?>">
                                Save
                            </button>
                        </div>


                    </div>

                </form>
            </div>
        </div>
    </div>

</div>


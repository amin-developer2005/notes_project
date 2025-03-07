<?php

use Core\Session;
use Core\Url;

$btnClasses = "shadow-sm my-7 bg-blue-700 text-white font-semibold border-transparent hover:bg-blue-500 focus:bg-green-800 dark:focus:bg-blue-900 rounded-md border border-transparent px-6 py-3 transition-colors ease-in-out tracking-widest duration-200 cursor-pointer tracking-widest focus:ring-3 focus:ring-indigo-500 focus:ring-offset-2";

?>

<?php
if (isset($errors)) {
    ?>
    <div class="flex flex-col sm:my-8 text-bold text-red-500">
        <?php
    foreach ($errors as $error) {
        ?>
        <p><?= $error ?></p>
        <?php
    }
    ?>
    </div>
<?php
}
?>

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">



            <div>
                <h1 class="mt-2 text-2xl text-center text-3xl font-bold tracking-tight text-white-900">Register for a new
                    account</h1>
            </div>

            <form class="mt-8 space-y-6" action="<?= Url::load('/account/register') ?>" method="POST">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="username" class="sr-only">Username</label>
                        <input id="username" name="username" type="text" autocomplete="username" required
                               class="relative block w-full appearance-none rounded-none rounded-t-md border border-white-300 px-3 py-2 text-white-900 placeholder-white-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Username"
                                value="<?= old('username') ?>"
                        >
                    </div>

                    <div class="sm:my-7">
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="relative block w-full appearance-none rounded-none rounded-t-md border border-white-300 px-3 py-2 text-white-900 placeholder-white-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Email address"
                                value="<?= old('email') ?>"
                        >
                    </div>

                    <div class="sm:my-7">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-white-300 px-3 py-2 text-white-900 placeholder-white-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Password">
                    </div>

                    <div class="sm:my-7">
                        <label for="Confirm Password" class="sr-only">Confirm Password</label>
                        <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="confirmPassword" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-white-300 px-3 py-2 text-white-900 placeholder-white-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Confirm Password">
                    </div>

                    <div class="sm:my-7">
                        <label for="mobile" class="sr-only">Mobile</label>
                        <input id="mobile" name="mobile" type="number" autocomplete="mobile" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-white-300 px-3 py-2 text-white-900 placeholder-white-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Mobile"
                                value="<?= old('mobile') ?>"
                        >
                    </div>

                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Register
                    </button>
                </div>

                <ul>
                    <?php if (isset($errors['email'])) : ?>
                        <li class="text-red-500 text-xs mt-2"><?= $errors['email'] ?></li>
                    <?php endif; ?>

                    <?php if (isset($errors['password'])) : ?>
                        <li class="text-red-500 text-xs mt-2"><?= $errors['password'] ?></li>
                    <?php endif; ?>
                </ul>
            </form>
        </div>
    </div>

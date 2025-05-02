<?php

use Core\Session;
use Core\Url;
?>

    <div class="flex min-h-full items-center justify-center py-4 px-4 sm:px-6 lg:px-8">


        <div class="w-full max-w-md">
            <div>
                <h2 class="mt-3 text-center text-4xl font-bold tracking-tight text-white-900">Log In</h2>
            </div>

            <div class="my-6">
                <ul>
                    <?php
                        if (isset($errors))  :
                            foreach ($errors as $error) :
                                foreach ($error as $err) :
                    ?>
                        <li class="text-red-500 text-l mt-2"><?= $err ?></li>
                    <?php
                        endforeach;
                        endforeach;
                        endif; ?>
                </ul>
            </div>



            <form class="mt-5 space-y-6" action="<?= Url::load('/session/store') ?>" method="POST">
                <div class="space-y-7 rounded-md shadow-sm py-8">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email"
                               name="email"
                               type="email"
                               autocomplete="email"
                               required
                               class="relative block w-full appearance-none rounded-none rounded-t-md border border-white-300 px-3 py-2 text-white-900 placeholder-white-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Email address"
                               value="<?= old('old')['email'] ?>">
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="current-password"
                               required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-white-300 px-3 py-2 text-white-900 placeholder-white-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Log In
                    </button>
                </div>


            </form>
        </div>
    </div>


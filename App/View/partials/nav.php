<?php
use Core\Url;
$classes = "bg-gray-300 dark:text-gray-900 hover:bg-blue-800 hover:text-white hover:border-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-3 focus:ring-offset-4 px-4 py-3 rounded-md text-l font-medium transition duration-200 ease-in-out tracking-widest dark:focus:bg-blue-700 active:bg-blue-800 cursor-pointer";
$uriIsClasses = "dark:text-white dark:bg-blue-700";
$defaultText = "text-black-300";

$submitBtnClasses = "inline-flex items-center px-4 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-l text-white dark:text-gray-800 tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-200 cursor-pointer";

?>

<nav class="bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-b-4 border-white/80 py-4 box-shadow">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">

                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-3 ">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="<?= Url::load('/home') ?>"
                           class="<?= urlIs('/home') ?  $uriIsClasses : $defaultText ?> <?= $classes ?>">Home</a>

                        <a href="<?= Url::load('/about') ?>"
                           class="<?= urlIs('/about') ?  $uriIsClasses : $defaultText ?> <?= $classes ?>">About</a>

                        <?php if (! isGuest()) :?>
                            <a href="<?=  Url::load('/notes') ?>"
                                   class="<?= urlIs('/notes') ?  $uriIsClasses : $defaultText ?> <?= $classes ?>">Notes</a>
                        <?php endif; ?>
                        <a href="<?= Url::load('/contact') ?>"
                           class="<?= urlIs('/contact') ?  $uriIsClasses : $defaultText ?> <?= $classes ?>">Contact</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                    <!-- Profile dropdown -->
                    <?php if ($_SESSION['user'] ?? false) { ?>


                        <div class="md:block">
                            <div class="ml-10 flex items-baseline space-x-3 ">
                                <a href="<?=  Url::load('/notes/create') ?>"
                                   class="<?= urlIs('/notes/create') ?  $uriIsClasses : $defaultText ?> <?= $classes ?> bg-blue-700">Create Note</a>

                                <div class="mx-4">
                                    <form action="<?= Url::load('/session/destroy') ?>" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                                class="<?= urlIs('/session/destroy') ?  $uriIsClasses : $defaultText ?> <?= $classes ?>">Log out</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="relative ml-3">
                            <button type="button"
                                    class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>

                                <img class="h-8 w-8 rounded-full"
                                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                     alt="">
                            </button>
                        </div>
                   <?php } else { ?>

                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-3 ">
                            <a href="<?= Url::load('/account/register') ?>"
                               class="<?= urlIs('/account/register') ?  $uriIsClasses : $defaultText ?> <?= $classes ?>">Register</a>

                            <a href="<?= Url::load('/account/login') ?>"
                               class="<?= urlIs('/account/login') ?  $uriIsClasses : $defaultText ?> <?= $classes ?>">Log In</a>
                        </div>
                    </div>

                    <?php } ?>


                </div>
            </div>
        </div>
        <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <button type="button"
                    class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <!--
                  Heroicon name: outline/bars-3

                  Menu open: "hidden", Menu closed: "block"
                -->
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
                <!--
                  Heroicon name: outline/x-mark

                  Menu open: "block", Menu closed: "hidden"
                -->
                <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
               aria-current="page">Dashboard</a>

            <a href="#"
               class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>

            <a href="#"
               class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>

            <a href="#"
               class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a>

            <a href="#"
               class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Reports</a>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full"
                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                         alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                    <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                </div>
                <button type="button"
                        class="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                </button>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                    Profile</a>

                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>

                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                    out</a>
            </div>
        </div>
    </div>
</nav>
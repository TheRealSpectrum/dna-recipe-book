<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/146730865b.js" crossorigin="anonymous"></script>
    <title>Blueprint Cooking</title>
</head>

<body>
    <!-- Header -->
    <div class="flex flex-col h-screen">
        <header class="text-gray-400 bg-gray-800 body-font">
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <span class="ml-3 text-xl">Blueprint Cooking</span>
                </a>
                <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                    <a href="/" class="mr-5 hover:text-white">Home</a>
                    <a href="#" class="mr-5 hover:text-white">Recipes</a>
                    <a href="#" class="mr-5 hover:text-white">Third Link</a>
                    <a href="#" class="mr-5 hover:text-white">Fourth Link</a>
                </nav>
                <button class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">Button
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </header>

        <?= $yield() ?>;

        <footer class="text-gray-400 bg-gray-800 body-font">
            <div class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
                <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
                    <a class="flex title-font font-medium items-center md:justify-start justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                        <span class="ml-3 text-xl">Tailblocks</span>
                    </a>
                    <p class="mt-2 text-sm text-gray-500">Air plant banjo lyft occupy retro adaptogen indego</p>
                </div>
                <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
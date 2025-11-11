<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Vue Attendance Dashboard</title>
    <!-- Load Vue 3 CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="/assets/tailwind.js">
    </script>
    <style src="/assets/styles.css"></style>
</head>

<body class="font-display bg-background-light dark:bg-background-dark text-[#111418] dark:text-gray-200 transition-colors duration-300"
    :class="{ 'dark': isDarkMode }">
    <div id="app" class="flex min-h-screen w-full">
        <!-- SideNavBar -->
        <aside
            class="flex w-64 flex-col border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark p-4">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3 px-2">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                        data-alt="Company logo for AttendTrack"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAiMO7dU_YsMzE7u-ZPypOy-9KW9XuA11LX0TFSD6S0yp68tLxhoOqkGKN_E8anQMxMtoqYOfYlym40iS13cgALaX7tgZWc1BRWcycImNeU8LbW8xZhYoddV5JwygeocnaThvgyBxR0yMKbVlNrFOj8UEMsI6pOH9WbrhrC2CFG0W7BeQOoxDkvVvAnoTVGsfv0AvBI6mPjYzHPhv3VadHqpOAeWnTOEV5ZPa4Qaj2pdsZ69P4GwiCD84im4xWrSnYW2o7GNnM9QsI");'>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-[#111418] dark:text-white text-base font-medium leading-normal">AttendTrack</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">HR Management</p>
                    </div>
                </div>
                <nav class="mt-6 flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary" href="/">
                        <span class="material-symbols-outlined !text-2xl"
                            style="font-variation-settings: 'FILL' 1;">dashboard</span>
                        <p class="text-sm font-medium leading-normal">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg"
                        href="#">
                        <span class="material-symbols-outlined !text-2xl">bar_chart</span>
                        <p class="text-sm font-medium leading-normal">Reports</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg"
                        href="#">
                        <span class="material-symbols-outlined !text-2xl">settings</span>
                        <p class="text-sm font-medium leading-normal">Settings</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg"
                        href="/admin/users">
                        <span class="material-symbols-outlined !text-2xl">group</span>
                        <p class="text-sm font-medium leading-normal">User Management</p>
                    </a>
                </nav>
            </div>
            <div class="mt-auto flex flex-col gap-2">
                <!-- Dark Mode Toggle -->
                <div @click="toggleDarkMode"
                    class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg cursor-pointer">
                    <span class="material-symbols-outlined !text-2xl">{{ isDarkMode ? 'light_mode' : 'dark_mode' }}</span>
                    <p class="text-sm font-medium leading-normal">{{ isDarkMode ? 'Light Mode' : 'Dark Mode' }}</p>
                </div>

                <div
                    class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg cursor-pointer">
                    <span class="material-symbols-outlined !text-2xl">help</span>
                    <p class="text-sm font-medium leading-normal">Support</p>
                </div>
<a href="/logout"
                    class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg cursor-pointer">
                    <span class="material-symbols-outlined !text-2xl">logout</span>
                    <p class="text-sm font-medium leading-normal">Logout</p>
                </a>
            </div>
        </aside>
        <?= $this->renderSection('content') ?>
    </div>
    <script src="/assets/app.js">
    </script>
</body>

</html>

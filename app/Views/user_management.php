<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<main class="flex-1 p-4 sm:p-8 overflow-y-auto">
    <div class="mx-auto max-w-7xl">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <p class="text-[#111418] dark:text-white text-3xl sm:text-4xl font-black leading-tight tracking-[-0.033em]">
                User Management</p>
            <a href="/admin/users/create"
                class="flex w-full sm:w-auto cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-4">
                <span class="material-symbols-outlined !text-xl">add</span>
                <span class="truncate">Add New User</span>
            </a>
        </div>

        <!-- Filter & Action Bar -->
        <div
            class="mb-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark p-4">
            <form class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-4 flex-1 min-w-[200px]">
                    <div class="relative w-full sm:w-auto">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        <input name="search"
                            class="w-full sm:w-64 rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 py-2 pl-10 pr-4 text-sm focus:border-primary focus:ring-primary dark:text-white"
                            placeholder="Search employee..." type="text" value="<?= esc($search ?? '') ?>" />
                    </div>
                    <div class="relative w-full sm:w-auto">
                        <select name="role"
                            class="w-full sm:w-auto rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 py-2 pl-3 pr-10 text-sm focus:border-primary focus:ring-primary dark:text-white">
                            <option value="">All Roles</option>
                            <option value="admin" <?= ($role ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="employee" <?= ($role ?? '') === 'employee' ? 'selected' : '' ?>>Employee</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="flex w-full sm:w-auto cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-4">
                    <span class="material-symbols-outlined !text-xl">filter_list</span>
                    <span class="truncate">Filter</span>
                </button>
            </form>
        </div>

        <!-- Data Table -->
        <div
            class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark shadow-lg">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-800 text-xs text-gray-600 dark:text-gray-400 uppercase">
                    <tr>
                        <th class="px-6 py-3" scope="col">Username</th>
                        <th class="px-6 py-3" scope="col">Role</th>
                        <th class="px-6 py-3" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-medium text-[#111418] dark:text-white"><?= esc($user['username']) ?></span>
                            </td>
                            <td class="px-6 py-4 capitalize"><?= esc($user['role']) ?></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="/admin/users/edit/<?= $user['id'] ?>" class="text-primary hover:underline">Edit</a>
                                    <form action="/admin/users/delete/<?= $user['id'] ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?= $this->endSection() ?>

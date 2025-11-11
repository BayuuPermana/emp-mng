<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<main class="flex-1 p-4 sm:p-8 overflow-y-auto">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <p class="text-[#111418] dark:text-white text-3xl sm:text-4xl font-black leading-tight tracking-[-0.033em]">
                <?= isset($user) ? 'Edit User' : 'Add User' ?>
            </p>
        </div>

        <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark p-4">
            <form action="<?= isset($user) ? '/admin/users/edit/' . $user['id'] : '/admin/users/create' ?>" method="post">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                        <input type="text" name="username" id="username" value="<?= isset($user) ? esc($user['username']) : '' ?>"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 py-2 px-3 text-sm focus:border-primary focus:ring-primary dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 py-2 px-3 text-sm focus:border-primary focus:ring-primary dark:text-white"
                            <?= isset($user) ? '' : 'required' ?>>
                        <?php if (isset($user)): ?>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Leave blank to keep the current password.</p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <select name="role" id="role"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 py-2 px-3 text-sm focus:border-primary focus:ring-primary dark:text-white">
                            <option value="admin" <?= isset($user) && $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="employee" <?= isset($user) && $user['role'] === 'employee' ? 'selected' : '' ?>>Employee</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="flex cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-4">
                        <span class="truncate">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
<?= $this->endSection() ?>

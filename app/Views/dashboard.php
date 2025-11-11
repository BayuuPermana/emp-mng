<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<main class="flex-1 p-4 sm:p-8 overflow-y-auto">
    <div class="mx-auto max-w-7xl">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <p class="text-[#111418] dark:text-white text-3xl sm:text-4xl font-black leading-tight tracking-[-0.033em]">
                Attendance Dashboard</p>
            <div class="flex items-center gap-4">
                <span
                    class="material-symbols-outlined text-gray-600 dark:text-gray-400 cursor-pointer">notifications</span>
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                    data-alt="User profile avatar"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCORQLYUdi0BbQTKCcVh9EamcQhLvAltfTTmj0Pluud74ucmbLWJV6uNJ2js_hES2eE7ZCPB5jEnlhX5bvqPbWoa6YZjqxgOgAlj5WdmVvWhuHpKuygXS29A5XDnZhNI1QoAz73J_mKCKuXSqcQJsF2vNUOjTRCi589x7D7wVA0TAjHgKXO1yl-RE5dQ9fHZ8GFCRqjUpc_Zmy5fcLtjc2rL2M6MeHLdHz1FHzK1mLAefEZeqQAYX4YDfwyC2BswnLw17LEwvQby2I");'>
                </div>
            </div>
        </div>

        <!-- Filter & Action Bar -->
        <div
            class="mb-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark p-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-4 flex-1 min-w-[200px]">
                    <div class="relative w-full sm:w-auto">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        <input v-model="searchTerm"
                            class="w-full sm:w-64 rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 py-2 pl-10 pr-4 text-sm focus:border-primary focus:ring-primary dark:text-white"
                            placeholder="Search employee..." type="text" />
                    </div>
                    <div class="relative w-full sm:w-auto">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">calendar_today</span>
                        <input v-model="selectedDate"
                            class="w-full sm:w-auto rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 py-2 pl-10 pr-4 text-sm focus:border-primary focus:ring-primary dark:text-white"
                            type="date" />
                    </div>
                </div>
                <button
                    class="flex w-full sm:w-auto cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-4">
                    <span class="material-symbols-outlined !text-xl">download</span>
                    <span class="truncate">Export Data</span>
                </button>
            </div>
            <!-- Chips for filtering -->
            <div class="flex gap-3 pt-4 overflow-x-auto">
                <button v-for="status in availableStatuses" :key="status" @click="filterStatus = status"
                    :class="[
                        'flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full px-4 text-sm font-medium leading-normal',
                        status === filterStatus
                            ? 'bg-primary/20 text-primary'
                            : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'
                    ]">
                    <p class="capitalize">{{ status === 'all' ? 'All' : status.replace('-', ' ') }}</p>
                </button>
            </div>
        </div>

        <!-- Data Table -->
        <div
            class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark shadow-lg">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-800 text-xs text-gray-600 dark:text-gray-400 uppercase">
                    <tr>
                        <th class="p-4" scope="col"><input
                                class="rounded border-gray-300 text-primary focus:ring-primary"
                                type="checkbox" :checked="isAllSelected" @change="toggleAllSelection" /></th>
                        <th class="px-6 py-3" scope="col">Employee Name</th>
                        <th class="px-6 py-3" scope="col">Clock-In</th>
                        <th class="px-6 py-3" scope="col">Clock-Out</th>
                        <th class="px-6 py-3" scope="col">Total Hours</th>
                        <th class="px-6 py-3" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    <tr v-if="filteredAttendance.length === 0">
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                            No attendance records found for the current filters.
                        </td>
                    </tr>
                    <tr v-for="record in filteredAttendance" :key="record.id"
                        class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <td class="p-4"><input class="rounded border-gray-300 text-primary focus:ring-primary"
                                type="checkbox" :checked="record.selected" @change="toggleRecordSelection(record.id)" /></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8 shrink-0"
                                    :style="{ 'background-image': 'url(\'' + record.avatarUrl + '\')' }">
                                </div>
                                <span class="font-medium text-[#111418] dark:text-white">{{ record.name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4" :class="{'text-gray-500': record.clockIn === '-'}">{{ record.clockIn }}</td>
                        <td class="px-6 py-4" :class="{'text-gray-500': record.clockOut === '-'}">{{ record.clockOut }}</td>
                        <td class="px-6 py-4" :class="{'text-gray-500': record.totalHours === '-'}">{{ record.totalHours }}</td>
                        <td class="px-6 py-4">
                            <span :class="statusClasses(record.status)"
                                class="inline-flex items-center text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ record.status.replace('-', ' ') }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination (Simple) -->
        <div class="flex flex-col sm:flex-row items-center justify-between mt-4 gap-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Showing <span class="font-medium">{{ (currentPage - 1) * itemsPerPage + 1 }}-{{ Math.min(currentPage * itemsPerPage, filteredAttendance.length) }}</span> of <span class="font-medium">{{ filteredAttendance.length }}</span> results
            </p>
            <div class="inline-flex items-center -space-x-px text-sm">
                <button :disabled="currentPage === 1" @click="currentPage--"
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white disabled:opacity-50 disabled:cursor-not-allowed">
                    Previous</button>
                <button v-for="page in totalPages" :key="page" @click="currentPage = page"
                    :aria-current="currentPage === page ? 'page' : null"
                    :class="[
                        'flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 dark:border-gray-700',
                        currentPage === page ? 'text-primary bg-primary/20 dark:bg-gray-700 dark:text-white font-semibold' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                        page === totalPages ? 'rounded-r-lg' : ''
                    ]">
                    {{ page }}</button>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>

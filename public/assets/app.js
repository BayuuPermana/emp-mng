

const { createApp, ref, computed, onMounted } = Vue;

        const App = {
            setup() {
                // --- State Management ---
                const attendanceData = ref([]);
                const searchTerm = ref('');
                const selectedDate = ref('2023-10-27');
                const filterStatus = ref('all');
                const currentPage = ref(1);
                const itemsPerPage = 5;
                const isDarkMode = ref(false);

                // Sample Data (MOCK)
                const mockData = [
                    { id: 1, name: 'Olivia Rhye', avatarUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuC96MlGijvLUj_oOUz08g-8H35I38KVS0ylysj29TyWDys_mcSU8rXeZ39RlQ38mxe6_Zsz1RKt0KhVBP3MjSjMHeLIuuY6Qw2PwpgwmBF3VzrPmXA31_JOsqkiyJCPVYGwySaiCtoavuT155xLoLUQE_hA7bTBtbDirx9hUUrZg__RVP0e8tMelWU8piUmnGK-AYOhMGg9Os2C2OJUR2wKuN7HK0tbICWwNBNZEk2LCk0FUn5Geyf0N7yYTHeBLExZ7GKbnGJLVM4", clockIn: '09:02 AM', clockOut: '05:05 PM', totalHours: '8h 3m', status: 'on-time', selected: false },
                    { id: 2, name: 'Phoenix Baker', avatarUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuCwINBM0F4X73iclz0BnIAGvI-H1dzfYJOl6tonJhSzsUWud4Kkrb-bhSvwwI3ztlanlUy3dWUYLy9K2gpb7-BcliZwilDPO9xeFHuWZzzzZtHhFAKHs4CT0DJgX0A8ljkAoBhRLsAx1EP_z4cjx4vyxwlFOgOt5FVgqh--s9sWYQG31l_cFuRddWqUDe9ysZS_RCVXWV91nAkzFhwEyG7SaB7mV0sPSo4Ffk_FPWoT3T5NoalZOwxZFJpgdgMf5r58ebXPwikwVtQ", clockIn: '09:17 AM', clockOut: '05:01 PM', totalHours: '7h 44m', status: 'late', selected: false },
                    { id: 3, name: 'Lana Steiner', avatarUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuCT81od61J2m82abSzxwp8S1t2G5mYIBq6SqUlJGL3ucz-Q8Z3f-XWxmW3O67JQ9RFDC0OraH57WjUAVbqSZo6fLIZWmVtLHqdwR4NQKME1X_tdW8quHdYXxPkAz1MFhTc3New4YpdiIl0cJlmFxtzbCwrvNygXY3t2dC-JbG3tKRXDXeF5FYC1YvRHttidau2n3eI1PYsHlRjOgDylMydycs-WKz-0PqcyH7BWGGz1XvSCHL6ROWBpzmvPw8cEk6IXvz_GwRitCAE", clockIn: '08:55 AM', clockOut: '04:58 PM', totalHours: '8h 3m', status: 'on-time', selected: false },
                    { id: 4, name: 'Demi Wilkinson', avatarUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuCu3CV8PpRlFYeQSHdesuTeavFNjFBiqyFpnkhlXkzAwXXT9YP2bpN2hpA1yidxTqmvi9Kkv0u_tVwfWh45cL2cFWwa_eM0bV_xLCmFM1hxWpya2vdLtUbsWLTBdnIIkp_JkkaTgkxV7xt_emKHcOU1P25wAoCrMxpMim4dQdnkojNQsRwTcKgRQ8ZpJ1INAxFvSEIFOSI8V3dbM7YeZpRdJ_fxYTPjG1DyomXfhyZJtSUlSWWcaIFC_O16uorD_LNHMGjbLBoYE0Y", clockIn: '-', clockOut: '-', totalHours: '-', status: 'absent', selected: false },
                    { id: 5, name: 'Candice Wu', avatarUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuAMs5HxkEvaPilDee2Nx7Bbh_EoHPQvbC8CH2bbaT1hespQxvcA-yS7soqez6DPD7ED8l5IWbyQDXHOQy_Gp65OZ7yhSm1QK5bNKz_nEYykfaPLkhgG8S9xMJg11MGTUmjVrE4Ff84uyrRs4lLgyrKk83CIyLhbGyIKKC6TSrzdRulSNqztTTYAZQ4J-Id9nyjPaT_4EFohiF2OWTq7UKsxFhi8QXeMhlctmcivjifMT29CwTNf018O9QBZ6u4KYq-I1uBfOsNgcg4", clockIn: '09:00 AM', clockOut: '05:01 PM', totalHours: '8h 1m', status: 'on-time', selected: false },
                    { id: 6, name: 'Drew James', avatarUrl: "https://placehold.co/32x32/1E3A8A/FFFFFF?text=DJ", clockIn: '09:05 AM', clockOut: '05:05 PM', totalHours: '8h 0m', status: 'on-time', selected: false },
                    { id: 7, name: 'Marcus Bell', avatarUrl: "https://placehold.co/32x32/3B82F6/FFFFFF?text=MB", clockIn: '09:20 AM', clockOut: '05:30 PM', totalHours: '8h 10m', status: 'late', selected: false },
                    { id: 8, name: 'Jessica Lee', avatarUrl: "https://placehold.co/32x32/10B981/FFFFFF?text=JL", clockIn: '-', clockOut: '-', totalHours: '-', status: 'absent', selected: false },
                    { id: 9, name: 'Chris Evans', avatarUrl: "https://placehold.co/32x32/F59E0B/FFFFFF?text=CE", clockIn: '08:45 AM', clockOut: '04:50 PM', totalHours: '8h 5m', status: 'on-time', selected: false },
                    { id: 10, name: 'Amy Wong', avatarUrl: "https://placehold.co/32x32/EC4899/FFFFFF?text=AW", clockIn: '09:15 AM', clockOut: '05:10 PM', totalHours: '7h 55m', status: 'late', selected: false },
                ];

                // Status chip labels
                const availableStatuses = ['all', 'on-time', 'late', 'absent'];

                // --- Methods ---

                /**
                 * Simulates fetching data from the CodeIgniter API.
                 * In a real app, this would be an actual fetch() call to the CodeIgniter endpoint.
                 */
                const fetchDataFromCI = async () => {
                    // Simulating API call to http://your-ci-app/api/attendance?date=...
                    console.log(`[Vue] Fetching data from CodeIgniter endpoint for date: ${selectedDate.value}`);
                    
                    // Delay to simulate network latency
                    await new Promise(resolve => setTimeout(resolve, 500));
                    
                    // In a real app, attendanceData.value = await fetch('/api/attendance').json();
                    attendanceData.value = mockData.map(d => ({ ...d, selected: false }));
                    console.log(`[Vue] Data loaded successfully.`);
                };

                const toggleDarkMode = () => {
                    isDarkMode.value = !isDarkMode.value;
                    document.documentElement.classList.toggle('dark', isDarkMode.value);
                };

                const statusClasses = (status) => {
                    switch (status) {
                        case 'on-time':
                            return 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300';
                        case 'late':
                            return 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300';
                        case 'absent':
                            return 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300';
                        default:
                            return 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300';
                    }
                };

                const toggleRecordSelection = (id) => {
                    const record = attendanceData.value.find(r => r.id === id);
                    if (record) {
                        record.selected = !record.selected;
                    }
                };

                const toggleAllSelection = () => {
                    const newValue = !isAllSelected.value;
                    attendanceData.value.forEach(record => {
                        record.selected = newValue;
                    });
                };

                // --- Computed Properties ---

                const filteredAndSearchedRecords = computed(() => {
                    let filtered = attendanceData.value;
                    const search = searchTerm.value.toLowerCase();

                    // 1. Filter by Status
                    if (filterStatus.value !== 'all') {
                        filtered = filtered.filter(record => record.status === filterStatus.value);
                    }

                    // 2. Filter by Search Term (Name)
                    if (search) {
                        filtered = filtered.filter(record => record.name.toLowerCase().includes(search));
                    }

                    return filtered;
                });

                const totalPages = computed(() => {
                    return Math.ceil(filteredAndSearchedRecords.value.length / itemsPerPage);
                });

                const filteredAttendance = computed(() => {
                    const start = (currentPage.value - 1) * itemsPerPage;
                    const end = start + itemsPerPage;
                    // Reset pagination if filter changes result in fewer pages
                    if (currentPage.value > totalPages.value && totalPages.value > 0) {
                        currentPage.value = 1;
                    }
                    return filteredAndSearchedRecords.value.slice(start, end);
                });

                const isAllSelected = computed(() => {
                    return filteredAttendance.value.length > 0 && filteredAttendance.value.every(record => record.selected);
                });


                // --- Lifecycle Hooks ---
                onMounted(() => {
                    // Initial data load when the component is mounted
                    fetchDataFromCI();
                });

                // Watch for date change to re-fetch data (simulate CI call)
                Vue.watch(selectedDate, (newDate) => {
                    console.log(`Date changed to ${newDate}. Re-fetching data...`);
                    fetchDataFromCI();
                });


                return {
                    attendanceData,
                    searchTerm,
                    selectedDate,
                    filterStatus,
                    currentPage,
                    itemsPerPage,
                    isDarkMode,
                    availableStatuses,
                    filteredAttendance,
                    totalPages,
                    isAllSelected,
                    toggleRecordSelection,
                    toggleAllSelection,
                    toggleDarkMode,
                    statusClasses,
                };
            },
        };

        // Initialize Vue Application
        createApp(App).mount('#app');
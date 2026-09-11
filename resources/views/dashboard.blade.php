<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Leads -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            إجمالي العملاء المحتملين
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $totalLeads }}
                        </p>
                    </div>
                </div>

                <!-- New Leads -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            العملاء الجدد
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $newLeads }}
                        </p>
                    </div>
                </div>

                <!-- Appointments -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            المواعيد
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $appointments }}
                        </p>
                    </div>
                </div>

                <!-- Deals -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            الصفقات
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $deals }}
                        </p>
                    </div>
                </div>

            </div>


            <!-- Latest Leads -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">
                        آخر العملاء المحتملين
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-right">

                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="px-4 py-3">الاسم</th>
                                    <th class="px-4 py-3">الجوال</th>
                                    <th class="px-4 py-3">الميزانية</th>
                                    <th class="px-4 py-3">الحالة</th>
                                    <th class="px-4 py-3">المصدر</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($latestLeads as $lead)

                                    <tr class="border-b border-gray-200 dark:border-gray-700">

                                        <td class="px-4 py-3">
                                            {{ $lead->full_name }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->phone }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->budget ?? 'غير محددة' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->status }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->source }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center">
                                            لا يوجد عملاء محتملين حاليًا.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>

                        <div class="mt-4">
    <a
        href="{{ route('leads.index') }}"
        class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400"
    >
        عرض جميع العملاء المحتملين →
    </a>
</div>
                    </div>

                </div>
            </div>


            <!-- ⭐ Upcoming Appointments -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">
                        المواعيد القادمة
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-right">

                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="px-4 py-3">العميل</th>
                                    <th class="px-4 py-3">نوع الموعد</th>
                                    <th class="px-4 py-3">التاريخ</th>
                                    <th class="px-4 py-3">الحالة</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($upcomingAppointments as $appointment)

                                    <tr class="border-b border-gray-200 dark:border-gray-700">

                                        <td class="px-4 py-3">
                                            {{ $appointment->lead?->full_name ?? 'غير محدد' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $appointment->type }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $appointment->appointment_date->format('Y-m-d H:i') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $appointment->status }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center">
                                            لا توجد مواعيد قادمة.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
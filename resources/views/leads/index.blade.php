<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            العملاء المحتملين
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ⭐ رسائل النجاح والخطأ --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif


            {{-- ⭐ Search & Filters --}}
            <div class="mb-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form method="GET" action="{{ route('leads.index') }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                            {{-- ⭐ Search --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    بحث
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ $search }}"
                                    placeholder="الاسم أو الجوال أو البريد"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >
                            </div>


                            {{-- ⭐ Status --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    الحالة
                                </label>

                                <select
                                    name="status"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >

                                    <option value="">كل الحالات</option>

                                    @foreach ($statuses as $item)
                                        <option
                                            value="{{ $item }}"
                                            @selected($status === $item)
                                        >
                                            {{ $item }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>


                            {{-- ⭐ Source --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    المصدر
                                </label>

                                <select
                                    name="source"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >

                                    <option value="">كل المصادر</option>

                                    @foreach ($sources as $item)
                                        <option
                                            value="{{ $item }}"
                                            @selected($source === $item)
                                        >
                                            {{ $item }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>


                            {{-- ⭐ Assigned User --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    المسؤول
                                </label>

                                <select
                                    name="assigned_user_id"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >

                                    <option value="">كل المسؤولين</option>

                                    @foreach ($users as $user)
                                        <option
                                            value="{{ $user->id }}"
                                            @selected((string) $assignedUser === (string) $user->id)
                                        >
                                            {{ $user->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>


                        {{-- ⭐ Buttons --}}
                        <div class="mt-4 flex gap-3">

                            <button
                                type="submit"
                                class="px-5 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            >
                                بحث وتصفية
                            </button>


                            <a
                                href="{{ route('leads.index') }}"
                                class="px-5 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md"
                            >
                                إعادة ضبط
                            </a>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ⭐ Leads Table --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">

                        <div>
                            <h3 class="text-lg font-semibold">
                                العملاء المحتملين
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                إجمالي النتائج: {{ $leads->total() }}
                            </p>
                        </div>


                        <a
                            href="{{ route('leads.create') }}"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                        >
                            + إضافة عميل محتمل
                        </a>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full text-sm text-right">

                            <thead>

                                <tr class="border-b border-gray-200 dark:border-gray-700">

                                    <th class="px-4 py-3">
                                        الاسم
                                    </th>

                                    <th class="px-4 py-3">
                                        الجوال
                                    </th>

                                    <th class="px-4 py-3">
                                        الميزانية
                                    </th>

                                    <th class="px-4 py-3">
                                        الحالة
                                    </th>

                                    <th class="px-4 py-3">
                                        المصدر
                                    </th>

                                    <th class="px-4 py-3">
                                        المسؤول
                                    </th>

                                    <th class="px-4 py-3">
                                        الإجراءات
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($leads as $lead)

                                    <tr class="border-b border-gray-200 dark:border-gray-700">

                                        <td class="px-4 py-3 font-medium">
                                            {{ $lead->full_name }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->phone }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->budget ? number_format($lead->budget, 2) . ' SAR' : 'غير محددة' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->status }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->source }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $lead->assignedUser?->name ?? 'غير محدد' }}
                                        </td>

                                        <td class="px-4 py-3">

                                            <div class="flex gap-3">

                                                <a
                                                    href="{{ route('leads.show', $lead) }}"
                                                    class="text-indigo-600 dark:text-indigo-400 hover:underline"
                                                >
                                                    عرض
                                                </a>

                                                <a
                                                    href="{{ route('leads.edit', $lead) }}"
                                                    class="text-gray-600 dark:text-gray-300 hover:underline"
                                                >
                                                    تعديل
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="7"
                                            class="px-4 py-8 text-center text-gray-500 dark:text-gray-400"
                                        >
                                            لا توجد نتائج مطابقة.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- ⭐ Pagination --}}
                    @if ($leads->hasPages())

                        <div class="mt-6">
                            {{ $leads->links() }}
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
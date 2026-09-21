<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            المشاريع
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


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">

                        <div>
                            <h3 class="text-lg font-semibold">
                                المشاريع
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                إدارة المشاريع والوحدات العقارية
                            </p>
                        </div>


                        <a
                            href="{{ route('projects.create') }}"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                        >
                            + إضافة مشروع
                        </a>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full text-sm text-right">

                            <thead>

                                <tr class="border-b border-gray-200 dark:border-gray-700">

                                    <th class="px-4 py-3">
                                        اسم المشروع
                                    </th>

                                    <th class="px-4 py-3">
                                        الموقع
                                    </th>

                                    <th class="px-4 py-3">
                                        الحالة
                                    </th>

                                    <th class="px-4 py-3">
                                        عدد الوحدات
                                    </th>

                                    <th class="px-4 py-3">
                                        الإجراءات
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($projects as $project)

                                    <tr class="border-b border-gray-200 dark:border-gray-700">

                                        <td class="px-4 py-3 font-medium">
                                            {{ $project->name }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $project->location }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $project->status }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $project->units_count }}
                                        </td>

                                        <td class="px-4 py-3">

                                            <div class="flex gap-3">

                                                <a
                                                    href="{{ route('projects.show', $project) }}"
                                                    class="text-indigo-600 dark:text-indigo-400 hover:underline"
                                                >
                                                    عرض
                                                </a>

                                                <a
                                                    href="{{ route('projects.edit', $project) }}"
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
                                            colspan="5"
                                            class="px-4 py-8 text-center text-gray-500 dark:text-gray-400"
                                        >
                                            لا توجد مشاريع حاليًا.
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
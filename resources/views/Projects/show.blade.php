<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            تفاصيل المشروع
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ⭐ الرسائل --}}
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


            {{-- معلومات المشروع --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center">

                        <div>

                            <h3 class="text-2xl font-bold">
                                {{ $project->name }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ $project->location }}
                            </p>

                        </div>


                        <a
                            href="{{ route('projects.edit', $project) }}"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                        >
                            تعديل
                        </a>

                    </div>


                    <div class="mt-6">

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            الحالة
                        </p>

                        <p class="mt-1 font-medium">
                            {{ $project->status }}
                        </p>

                    </div>


                    @if ($project->description)

                        <div class="mt-6">

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                الوصف
                            </p>

                            <p class="mt-1">
                                {{ $project->description }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- الوحدات --}}
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-4">

                        <h3 class="text-lg font-semibold">
                            الوحدات
                        </h3>

                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $project->units->count() }} وحدة
                        </span>

                    </div>


                    @forelse ($project->units as $unit)

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">

                            <div class="flex justify-between items-center">

                                <div>

                                    <p class="font-semibold">
                                        الوحدة {{ $unit->unit_number }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        النوع: {{ $unit->type }}
                                    </p>

                                    <p class="text-sm">
                                        المساحة:
                                        {{ $unit->area ?? 'غير محددة' }}
                                    </p>

                                    <p class="text-sm">
                                        السعر:
                                        {{ number_format($unit->price, 2) }} SAR
                                    </p>

                                    <p class="text-sm">
                                        الحالة:
                                        {{ $unit->status }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    @empty

                        <p class="text-gray-500 dark:text-gray-400">
                            لا توجد وحدات مرتبطة بهذا المشروع.
                        </p>

                    @endforelse

                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-6 flex gap-3">

                <a
                    href="{{ route('projects.index') }}"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-md"
                >
                    العودة إلى المشاريع
                </a>


                <form
                    method="POST"
                    action="{{ route('projects.destroy', $project) }}"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md"
                    >
                        حذف المشروع
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
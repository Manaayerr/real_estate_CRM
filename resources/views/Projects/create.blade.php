<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            إضافة مشروع
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('projects.store') }}">

                        @csrf


                        {{-- الاسم --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium mb-2">
                                اسم المشروع
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required
                            >

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- الموقع --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium mb-2">
                                الموقع
                            </label>

                            <input
                                type="text"
                                name="location"
                                value="{{ old('location') }}"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required
                            >

                            @error('location')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- الحالة --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium mb-2">
                                الحالة
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required
                            >

                                <option value="active" @selected(old('status', 'active') === 'active')>
                                    active
                                </option>

                                <option value="inactive" @selected(old('status') === 'inactive')>
                                    inactive
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- الوصف --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium mb-2">
                                الوصف
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <div class="flex gap-3">

                            <button
                                type="submit"
                                class="px-5 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            >
                                حفظ المشروع
                            </button>

                            <a
                                href="{{ route('projects.index') }}"
                                class="px-5 py-2 bg-gray-200 dark:bg-gray-700 rounded-md"
                            >
                                إلغاء
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
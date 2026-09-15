<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            تفاصيل العميل المحتمل
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <!-- Lead Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center">

                        <div>
                            <h3 class="text-2xl font-bold">
                                {{ $lead->full_name }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                العميل المحتمل #{{ $lead->id }}
                            </p>
                        </div>


                        <a
                            href="{{ route('leads.edit', $lead) }}"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                        >
                            تعديل
                        </a>

                    </div>


                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                الجوال
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->phone }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                البريد الإلكتروني
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->email ?? 'غير محدد' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                الميزانية
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->budget ? number_format($lead->budget, 2) . ' SAR' : 'غير محددة' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                الحالة
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->status }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                المصدر
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->source }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                الغرض من الشراء
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->purchase_purpose }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                طريقة الدفع
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->payment_method }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                المسؤول
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $lead->assignedUser?->name ?? 'غير محدد' }}
                            </p>
                        </div>

                    </div>


                    @if ($lead->notes)

                        <div class="mt-6">

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                الملاحظات
                            </p>

                            <p class="mt-1">
                                {{ $lead->notes }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            <!-- Interested Units -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">
                        الوحدات المهتم بها
                    </h3>


                    @forelse ($lead->units as $unit)

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">

                            <p class="font-semibold">
                                الوحدة {{ $unit->unit_number }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                المشروع: {{ $unit->project?->name ?? 'غير محدد' }}
                            </p>

                            <p class="text-sm">
                                النوع: {{ $unit->type }}
                            </p>

                            <p class="text-sm">
                                السعر: {{ number_format($unit->price, 2) }} SAR
                            </p>

                            <p class="text-sm">
                                حالة الاهتمام:
                                {{ $unit->pivot->interest_status }}
                            </p>

                        </div>

                    @empty

                        <p class="text-gray-500 dark:text-gray-400">
                            لا توجد وحدات مرتبطة بهذا العميل.
                        </p>

                    @endforelse

                </div>

            </div>


            <!-- Activities -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">
                        الأنشطة
                    </h3>


                    @forelse ($lead->activities as $activity)

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">

                            <p class="font-semibold">
                                {{ $activity->type }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $activity->activity_date?->format('Y-m-d H:i') }}
                            </p>

                            <p class="mt-1">
                                {{ $activity->notes ?? 'لا توجد ملاحظات' }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                بواسطة: {{ $activity->user?->name ?? 'غير محدد' }}
                            </p>

                        </div>

                    @empty

                        <p class="text-gray-500 dark:text-gray-400">
                            لا توجد أنشطة لهذا العميل.
                        </p>

                    @endforelse

                </div>

            </div>


            <!-- Appointments -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">
                        المواعيد
                    </h3>


                    @forelse ($lead->appointments as $appointment)

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">

                            <p class="font-semibold">
                                {{ $appointment->type }}
                            </p>

                            <p class="text-sm">
                                التاريخ:
                                {{ $appointment->appointment_date?->format('Y-m-d H:i') }}
                            </p>

                            <p class="text-sm">
                                الحالة: {{ $appointment->status }}
                            </p>

                            <p class="text-sm">
                                الوحدة:
                                {{ $appointment->unit?->unit_number ?? 'غير محددة' }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                بواسطة:
                                {{ $appointment->user?->name ?? 'غير محدد' }}
                            </p>

                        </div>

                    @empty

                        <p class="text-gray-500 dark:text-gray-400">
                            لا توجد مواعيد لهذا العميل.
                        </p>

                    @endforelse

                </div>

            </div>


            <!-- Deals -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">
                        الصفقات
                    </h3>


                    @forelse ($lead->deals as $deal)

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">

                            <p class="font-semibold">
                                {{ $deal->type }}
                            </p>

                            <p class="text-sm">
                                المبلغ:
                                {{ number_format($deal->amount, 2) }} SAR
                            </p>

                            <p class="text-sm">
                                الحالة: {{ $deal->status }}
                            </p>

                            <p class="text-sm">
                                النتيجة:
                                {{ $deal->result ?? 'غير محددة' }}
                            </p>

                            <p class="text-sm">
                                الوحدة:
                                {{ $deal->unit?->unit_number ?? 'غير محددة' }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                بواسطة:
                                {{ $deal->user?->name ?? 'غير محدد' }}
                            </p>

                        </div>

                    @empty

                        <p class="text-gray-500 dark:text-gray-400">
                            لا توجد صفقات لهذا العميل.
                        </p>

                    @endforelse

                </div>

            </div>


            <!-- Customer -->
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">
                        العميل
                    </h3>


                    @if ($lead->customer)

                        <p class="font-semibold">
                            {{ $lead->customer->full_name }}
                        </p>

                        <p class="text-sm">
                            الجوال: {{ $lead->customer->phone }}
                        </p>

                        <p class="text-sm">
                            البريد:
                            {{ $lead->customer->email ?? 'غير محدد' }}
                        </p>

                        <p class="mt-2">
                            ✓ تم تحويل العميل من Lead إلى Customer
                        </p>

                    @else

                        <p class="text-gray-500 dark:text-gray-400">
                            لم يتم تحويل هذا العميل إلى Customer بعد.
                        </p>

                    @endif

                </div>

            </div>


            <!-- Actions -->
            <div class="mt-6 flex gap-4">

                <a
                    href="{{ route('leads.index') }}"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-md"
                >
                    العودة إلى العملاء
                </a>


                <form
                    method="POST"
                    action="{{ route('leads.destroy', $lead) }}"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md"
                    >
                        حذف
                    </button>

                </form>

            </div>


        </div>

    </div>

</x-app-layout>
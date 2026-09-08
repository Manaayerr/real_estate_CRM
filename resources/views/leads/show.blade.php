@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif


<h1>تفاصيل العميل</h1>

<p><strong>الاسم:</strong> {{ $lead->full_name }}</p>

<p><strong>الجوال:</strong> {{ $lead->phone }}</p>

<p><strong>البريد الإلكتروني:</strong> {{ $lead->email ?? 'غير محدد' }}</p>

<p><strong>الميزانية:</strong> {{ $lead->budget ?? 'غير محددة' }}</p>

<p><strong>غرض الشراء:</strong> {{ $lead->purchase_purpose }}</p>

<p><strong>طريقة الدفع:</strong> {{ $lead->payment_method }}</p>

<p><strong>المصدر:</strong> {{ $lead->source }}</p>

<p><strong>الحالة:</strong> {{ $lead->status }}</p>

<p><strong>الملاحظات:</strong> {{ $lead->notes ?? 'لا توجد ملاحظات' }}</p>

<br>

<a href="{{ route('leads.edit', $lead) }}">
    تعديل العميل
</a>

<form method="POST" action="{{ route('leads.destroy', $lead) }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        حذف العميل
    </button>
</form>
<br><br>

<a href="{{ route('leads.index') }}">العودة إلى العملاء</a>
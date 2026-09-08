<h1>تعديل العميل</h1>

<form method="POST" action="{{ route('leads.update', $lead) }}">
    @csrf
    @method('PUT')

    <div>
        <label>الاسم الكامل</label>
        <input type="text" name="full_name" value="{{ $lead->full_name }}">
    </div>

    <br>

    <div>
        <label>رقم الجوال</label>
        <input type="text" name="phone" value="{{ $lead->phone }}">
    </div>

    <br>

    <div>
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ $lead->email }}">
    </div>

    <br>

    <div>
        <label>الميزانية</label>
        <input type="number" name="budget" value="{{ $lead->budget }}">
    </div>

    <br>

    <div>
        <label>غرض الشراء</label>
        <select name="purchase_purpose">
            <option value="residential" @selected($lead->purchase_purpose === 'residential')>
                سكني
            </option>

            <option value="investment" @selected($lead->purchase_purpose === 'investment')>
                استثماري
            </option>
        </select>
    </div>

    <br>

    <div>
        <label>طريقة الدفع</label>
        <select name="payment_method">
            <option value="bank" @selected($lead->payment_method === 'bank')>
                تمويل بنكي
            </option>

            <option value="cash" @selected($lead->payment_method === 'cash')>
                كاش
            </option>
        </select>
    </div>

    <br>

    <div>
        <label>المصدر</label>
        <select name="source">
            <option value="website" @selected($lead->source === 'website')>
                الموقع الإلكتروني
            </option>

            <option value="social_media" @selected($lead->source === 'social_media')>
                التواصل الاجتماعي
            </option>

            <option value="referral" @selected($lead->source === 'referral')>
                إحالة
            </option>
        </select>
    </div>

    <br>

    <div>
        <label>الحالة</label>
        <select name="status">
            <option value="new" @selected($lead->status === 'new')>
                جديد
            </option>

            <option value="contacted" @selected($lead->status === 'contacted')>
                تم التواصل
            </option>

            <option value="qualified" @selected($lead->status === 'qualified')>
                مؤهل
            </option>
        </select>
    </div>

    <br>

    <div>
        <label>ملاحظات</label>
        <textarea name="notes">{{ $lead->notes }}</textarea>
    </div>

    <br>

    <button type="submit">حفظ التعديلات</button>
</form>
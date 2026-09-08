<h1>إضافة عميل محتمل</h1>

<form method="POST" action="{{ route('leads.store') }}">
    @csrf

    <div>
        <label>الاسم الكامل</label>
        <input type="text" name="full_name">
    </div>

    <br>

    <div>
        <label>رقم الجوال</label>
        <input type="text" name="phone">
    </div>

    <br>

    <div>
        <label>البريد الإلكتروني</label>
        <input type="email" name="email">
    </div>

    <br>

    <div>
        <label>الميزانية</label>
        <input type="number" name="budget">
    </div>

    <br>

    <div>
        <label>غرض الشراء</label>
        <select name="purchase_purpose">
            <option value="residential">سكني</option>
            <option value="investment">استثماري</option>
        </select>
    </div>

    <br>

    <div>
        <label>طريقة الدفع</label>
        <select name="payment_method">
            <option value="bank">تمويل بنكي</option>
            <option value="cash">كاش</option>
        </select>
    </div>

    <br>

    <div>
        <label>المصدر</label>
        <select name="source">
            <option value="website">الموقع الإلكتروني</option>
            <option value="social_media">التواصل الاجتماعي</option>
            <option value="referral">إحالة</option>
        </select>
    </div>

    <br>

    <div>
        <label>الحالة</label>
        <select name="status">
            <option value="new">جديد</option>
            <option value="contacted">تم التواصل</option>
            <option value="qualified">مؤهل</option>
        </select>
    </div>

    <br>

    <div>
        <label>ملاحظات</label>
        <textarea name="notes"></textarea>
    </div>

    <br>

    <button type="submit">إضافة العميل</button>
</form>
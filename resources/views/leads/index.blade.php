<h1>Leads</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>الجوال</th>
            <th>الميزانية</th>
            <th>الحالة</th>
            <th>المصدر</th>
            <th>المسؤول</th>
            <th>الإجراءات</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($leads as $lead)
            <tr>
                <td>
                    {{ $lead->full_name }}
                </td>

                <td>
                    {{ $lead->phone }}
                </td>

                <td>
                    {{ $lead->budget ?? 'غير محددة' }}
                </td>

                <td>
                    {{ $lead->status }}
                </td>

                <td>
                    {{ $lead->source }}
                </td>

                <td>
                    {{ $lead->assignedUser?->name ?? 'غير محدد' }}
                </td>

                <td>
                    <a href="{{ route('leads.show', $lead) }}">
                        عرض
                    </a>

                    |

                    <a href="{{ route('leads.edit', $lead) }}">
                        تعديل
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>

<a href="{{ route('leads.create') }}">
    + إضافة عميل محتمل
</a>
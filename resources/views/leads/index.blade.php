@foreach ($leads as $lead)
    <p>
        <a href="{{ route('leads.show', $lead) }}">
            {{ $lead->full_name }}
        </a>

        -
        {{ $lead->phone }}
    </p>
@endforeach
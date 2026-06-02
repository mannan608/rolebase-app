@props([
    'slug',
])

@php
    $courseForms = [
        'certificate-iii-in-business' => 'YVAVfNk71nvX1T2IXT9O',
        'certificate-iv-in-business' => '42DfrIjt7p825OUVrWr6',
        'certificate-iii-in-process-manufacturing' => 'Fl07NcHv69HFx5Oj5xHn',
        'certificate-ii-in-retail-services' => 'km4iIpEfZrrMBnabcHGM',
        'certificate-iii-in-retail' => 'cNjSxaRVL3qF4PlV7a5U',
        'certificate-iv-in-retail-management' => 'F2hyMiRCLuetCp9uXnCD',
        'certificate-ii-in-hospitality' => 'YDsSmrKxXhpJ171svwqR',
        'certificate-iii-in-hospitality' => 'aluvYpKUihTVz99YEmOO',
        'certificate-iv-in-hospitality' => 'WJLXLqpYrV01wzI4Z6hO',
    ];

    $formId = $courseForms[$slug] ?? null;
@endphp

@if ($formId)
    <iframe
        src="https://api.leadconnectorhq.com/widget/form/{{ $formId }}"
        style="width:100%;height:100%;border:none;border-radius:8px"
        id="inline-{{ $formId }}"
        data-layout="{'id':'INLINE'}"
        data-trigger-type="alwaysShow"
        data-trigger-value=""
        data-activation-type="alwaysActivated"
        data-activation-value=""
        data-deactivation-type="neverDeactivate"
        data-deactivation-value=""
        data-height="465"
        data-layout-iframe-id="inline-{{ $formId }}"
        data-form-id="{{ $formId }}"
        title="Quick Apply Form"
    >
    </iframe>

    @once
        <script src="https://link.msgsndr.com/js/form_embed.js"></script>
    @endonce
@endif
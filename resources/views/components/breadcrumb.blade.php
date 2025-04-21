<div class="d-flex align-items-center justify-content-end">
    <ol class="ms-3 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                <i class="fa-duotone fa-solid fa-house fs-6"></i>
            </a>
        </li>
        {{ $slot }}
    </ol>
</div>

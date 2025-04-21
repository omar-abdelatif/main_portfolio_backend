@section('title')
    Pricing Plans | Details
@endsection
@section('breadcrumb-title')
    <h3>Pricing Plans Details</h3>
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{route('pricing.index')}}">Pricing Plans</a>
    </li>
    <li class="breadcrumb-item active">{{ $plan->name }} Plan Details</li>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/custom.js')}}"></script>
@endsection
@section('modals')
    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#new-cat">New Feature</button>
    <div class="modal fade" id="new-cat" tabindex="-1"  aria-labelledby="newFeatureLabel" aria-describedby="newFeatureDescription" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Pricing Plan Features</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pricing.items.store', $plan->id) }}" method="post" id="pricing-items-form">
                        @csrf
                        <div class="space-y-4">
                            <div class="form-group">
                                <x-input-label for="plan_name" value="Plan Name" class="form-label" />
                                <div class="d-flex align-items-center">
                                    <x-text-input id="plan_name" type="text" name="name[]" placeholder="Plan Name" class="w-full" required />
                                    <button type="button" class="btn btn-success px-2 py-2 ms-2 add-feature">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="features-container" class="space-y-2"></div>
                            <div class="modal-footer mt-3">
                                <x-secondary-button class="rounded" data-bs-dismiss="modal">Close</x-secondary-button>
                                <x-primary-button class="rounded btn btn-primary">Confirm</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-app-layout>
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ $error }}',
                });
            @endforeach
        </script>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped align-middle" data-page-length="10">
                    <thead>
                        <tr>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="text-center">{{$item->title}}</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_item_{{$item->id}}">
                                        <i class="fa-solid fa-pen-to-square fa-xl text-muted py-1"></i>
                                    </button>
                                    <div class="modal fade" id="edit_item_{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Feature</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('pricing.items.update', $item->id) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <x-input-label for="plan_name" value="Plan Name" class="form-label" />
                                                            <x-text-input id="plan_name" type="text" name="title" value="{{$item->title}}"/>
                                                        </div>
                                                        <div class="modal-footer mt-3">
                                                            <x-secondary-button class="rounded" data-bs-dismiss="modal">Close</x-secondary-button>
                                                            <x-primary-button class="rounded btn btn-primary">Confirm</x-primary-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_item_{{$item->id}}">
                                        <i class="fa-solid fa-trash-can fa-xl text-muted py-1"></i>
                                    </button>
                                    <div class="modal fade" id="delete_item_{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Feature</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('pricing.items.delete', $item->id) }}" method="get">
                                                        @csrf
                                                        <h3 class="mb-0">Are you sure you want to delete this feature?</p>
                                                            <div class="modal-footer mt-3">
                                                                <x-secondary-button class="rounded" data-bs-dismiss="modal">Close</x-secondary-button>
                                                                <x-primary-button type="submit" class="rounded btn btn-danger">Confirm</x-primary-button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
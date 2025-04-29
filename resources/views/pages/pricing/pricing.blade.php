@section('title')
    Pricing Plans
@endsection
@section('breadcrumb-title')
    <h3>Pricing Plans</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Pricing Plans</li>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/custom.js')}}"></script>
@endsection

@section('modals')
    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#new-cat">New Pricing Plan</button>
    <div class="modal fade" id="new-cat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Pricing Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pricing.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <x-input-label for="plan_name" value="Plan Name" class="form-label" />
                            <x-text-input class="text-white" id="plan_name" type="text" name="name" placeholder="Plan Name"/>
                        </div>
                        <div class="form-group mb-2">
                            <x-input-label for="plan_price" value="Plan price" />
                            <x-text-input class="text-white" id="plan_price" type="price" name="price" placeholder="Plan price"/>
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
@endsection

<x-app-layout>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                sweetalertError($error);
            @endphp
        @endforeach
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped align-middle" data-page-length="10">
                    <thead>
                        <tr>
                            <th class="text-center text-white">Name</th>
                            <th class="text-center text-white">Price</th>
                            <th class="text-center text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td class="text-white text-center">{{$plan->name}}</td>
                                <td class="text-white text-center">{{$plan->price}} {{$plan->currency}}</td>
                                <td class="text-white text-center">
                                    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_plan_{{$plan->id}}">
                                        <i class="fa-solid fa-pen-to-square fa-xl text-muted py-1"></i>
                                    </button>
                                    <div class="modal fade" id="edit_plan_{{$plan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Plan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('pricing.update')}}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id" value="{{$plan->id}}">
                                                        <div class="form-group mb-2">
                                                            <x-input-label for="plan_name" value="Plan Name" class="form-label" />
                                                            <x-text-input class="text-white" id="plan_name" type="text" name="name" value="{{$plan->name}}"/>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <x-input-label for="plan_price" value="Plan price" />
                                                            <x-text-input class="text-white" id="plan_price" type="price" name="price" value="{{$plan->price}}"/>
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
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_plan_{{$plan->id}}">
                                        <i class="fa-solid fa-trash-can fa-xl text-muted py-1"></i>
                                    </button>
                                    <div class="modal fade" id="delete_plan_{{$plan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Plan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('pricing.destroy', $plan->id)}}" method="post">
                                                        @csrf
                                                        @method('GET')
                                                        <h1 class="text-center my-2">Are you sure you want to delete this plan?</h1>
                                                        <div class="modal-footer mt-3">
                                                            <x-secondary-button class="rounded" data-bs-dismiss="modal">Close</x-secondary-button>
                                                            <x-primary-button class="rounded btn btn-danger">Confirm</x-primary-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <x-anchor route="pricing.items.index" class="btn-outline-success px-2" params="{{$plan->id}}" icon="fa-solid fa-eye fa-xl"></x-anchor>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
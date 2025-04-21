@section('title')
    Categories
@endsection
@section('breadcrumb-title')
    <h3>Categories</h3>
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('modals')
    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#new-cat">New Cat.</button>
    <div class="modal fade" id="new-cat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categories.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="catname" class="from-label">Category Name</label>
                            <input type="text" name="name" id="catname" class="form-control text-white" placeholder="Category Name">
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
@section('scripts')
    <script src="{{ asset('assets/js/custom.js')}}"></script>
@endsection
<x-app-layout>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                sweetalertError($error);
            @endphp
        @endforeach
    @endif
    <div class="table-responsive">
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped align-middle" data-page-length="25">
                    <thead>
                        <tr>
                            <th class="text-white text-center" scope="col">Name</th>
                            <th class="text-white text-center" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cats as $cat)
                            <tr>
                                <td class="text-center">{{$cat->name}}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_cat_{{$cat->id}}">
                                        <i data-feather="edit"></i>
                                    </button>
                                    <div class="modal fade" id="edit_cat_{{$cat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Category {{$cat->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('categories.update')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$cat->id}}">
                                                        <div class="form-group">
                                                            <label for="catname" class="from-label">Category Name</label>
                                                            <input type="text" name="name" id="catname" class="form-control text-white" value="{{$cat->name}}" placeholder="Category Name" value="{{$cat->name}}">
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
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_cat_{{$cat->id}}">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                    <div class="modal fade" id="delete_cat_{{$cat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Category {{$cat->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('categories.delete', $cat->id) }}" method="get">
                                                        @csrf
                                                        <div class="form-group mb-3">
                                                            <h1 class="text-center">Are You Sure ?</h1>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <x-secondary-button class="rounded" data-bs-dismiss="modal">Close</x-secondary-button>
                                                            <x-primary-button class="rounded btn btn-primary">Confirm</x-primary-button>
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
@section('title', 'Project Gallery')

@section('breadcrumb-title')
    <h3>{{ $project->name }} Gallery</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('projects.index') }}">Projects</a>
    </li>
    <li class="breadcrumb-item active">{{ $project->name }} Gallery</li>
@endsection

@section('modals')
    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#add_gallery">
        <i class="fa fa-plus"></i> Add Images
    </button>
    <div class="modal fade" id="add_gallery" tabindex="-1" aria-labelledby="addGalleryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGalleryLabel">Add Gallery Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('galleries.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $project->slug }}">
                        <div class="form-group mb-3">
                            <label for="images" class="form-label">Upload Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" required>
                            <small class="text-danger">You can select multiple images (max 2MB each)</small>
                        </div>
                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary">Upload Images</button>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Project Gallery</h5>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-striped align-middle" data-page-length="10">
                            <thead>
                                <tr>
                                    <th class=" text-center">Image</th>
                                    <th class=" text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($project->galleries as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset($item->image) }}" width="50" alt="Project-img">
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger px-3 py-2" data-bs-toggle="modal" href="#delete_gallery_{{$item->id}}">
                                                <i class="fa-solid fa-trash-can fa-xl py-1"></i>
                                            </a>
                                            <div class="modal fade" id="delete_gallery_{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Image</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('galleries.destroy', $item->id)}}" method="get">
                                                                @csrf
                                                                <h1 class="text-center my-2">Are you sure you want to delete this image?</h1>
                                                                <div class="modal-footer mt-3">
                                                                    <x-secondary-button class="rounded" data-bs-dismiss="modal">Close</x-secondary-button>
                                                                    <x-primary-button class="rounded btn btn-danger">Confirm</x-primary-button>
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
        </div>
    </div>
</x-app-layout>
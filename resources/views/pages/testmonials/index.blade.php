@section('title')
    Testmonials
@endsection
@section('breadcrumb-title')
    <h3>Testmonials</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Testmonials</li>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/custom.js')}}"></script>
@endsection

@section('modals')
    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#new-cat">New Testmonial</button>
    <div class="modal fade" id="new-cat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Testmonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('testmonials.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="slug" value="{{$project->slug}}">
                        <div class="form-group mb-3">
                            <x-input-label for="reviewer_name" value="Reviewer Name" class="form-label" />
                            <x-text-input id="reviewer_name" type="text" name="name" placeholder="Reviewer Name" class="text-white"/>
                        </div>
                        <div class="form-group mb-3">
                            <x-input-label for="reviewer_position" value="Reviewer Position" class="form-label" />
                            <x-text-input id="reviewer_position" type="text" name="position" placeholder="Reviewer Position" class="text-white"/>
                        </div>
                        <div class="form-group mb-3">
                            <x-input-label for="reviewer_image" value="Reviewer Image" />
                            <x-text-input type="file" name="image" id="reviewer_image" accept="image/*" />
                        </div>
                        <div class="form-group mb-3">
                            <x-input-label for="project_description" value="Reviewer Content" />
                            <x-textarea name="content" id="project_description" rows="3" placeholder="Reviewer Content"></x-textarea>
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
                            <th class="text-center text-white">Position</th>
                            <th class="text-center text-white">Image</th>
                            <th class="text-center text-white">Content</th>
                            <th class="text-center text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($project->testmonials->id)
                            <tr>
                                <td class="text-center">{{$project->testmonials->name}}</td>
                                <td class="text-center">{{$project->testmonials->position}}</td>
                                <td class="text-center">
                                    @isset($project->testmonials->image)
                                        <img src="{{ asset($project->testmonials->image) }}" width="50" alt="Project-img">
                                    @endisset
                                    <span class="fw-bold">-</span>
                                </td>
                                <td class="text-center">{{$project->testmonials->content}}</td>
                                <td class="text-center">
                                    <a class="btn btn-outline-warning px-3" data-bs-toggle="modal" href="#edit_testmonials_{{$project->testmonials->id}}">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <div class="modal fade" id="edit_testmonials_{{$project->testmonials->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Testmonial</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('testmonials.update')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$project->testmonials->id}}">
                                                        <div class="form-group mb-3">
                                                            <x-input-label for="reviewer_name" value="Reviewer Name" class="form-label" />
                                                            <x-text-input id="reviewer_name" type="text" name="name" value="{{$project->testmonials->name}}" placeholder="Reviewer Name" class="text-white"/>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <x-input-label for="reviewer_position" value="Reviewer Position" class="form-label" />
                                                            <x-text-input id="reviewer_position" type="text" name="position" value="{{$project->testmonials->position}}" placeholder="Reviewer Position" class="text-white"/>
                                                        </div>
                                                        @isset($project->testmonials->image)
                                                            <div class="view-image my-3">
                                                                <img src="{{asset($project->testmonials->image)}}" width="80" class="rounded" alt="{{$project->name}}">
                                                            </div>
                                                        @endisset
                                                        <div class="form-group mb-3">
                                                            <x-input-label for="reviewer_image" value="Reviewer Image" />
                                                            <x-text-input type="file" name="image" id="reviewer_image" accept="image/*" />
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <x-input-label for="project_description" value="Reviewer Content" />
                                                            <x-textarea name="content" id="project_description" rows="3" placeholder="Reviewer Content">{{$project->testmonials->content}}</x-textarea>
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
                                    <a class="btn btn-outline-danger px-3" data-bs-toggle="modal" data-bs-target="#delete_testmoials_{{$project->testmonials->id}}">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                    <div class="modal fade" id="delete_testmoials_{{$project->testmonials->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Testmonial</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('testmonials.destroy', $project->testmonials->id)}}" method="get">
                                                        @csrf
                                                        <h1 class="text-center my-2">Are you sure you want to delete this testmonial?</h1>
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
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
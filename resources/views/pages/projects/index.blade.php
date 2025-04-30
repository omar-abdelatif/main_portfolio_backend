@section('title')
    Projects
@endsection
@section('breadcrumb-title')
    <h3>Projects</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Projects</li>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/tagify.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2/tagify.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js')}}"></script>
@endsection

@section('modals')
    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#new-cat">New Project</button>
    <div class="modal fade" id="new-cat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('projects.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <x-input-label for="project_name" value="Project Name" class="form-label" />
                                    <x-text-input id="project_name" type="text" name="name" placeholder="Project Name" class="text-white"/>
                                </div>
                                <div class="form-group mb-2">
                                    <x-input-label for="project_url" value="Project Url" />
                                    <x-text-input id="project_url" type="url" name="link" placeholder="Project Url" class="text-white"/>
                                </div>
                                <div class="form-group">
                                    <x-input-label for="tags" value="Project Tags" />
                                    <x-text-input id="tags" type="text" name="tags" placeholder="Project Tags"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <x-input-label for="category_name" value="Category Name" />
                                    <x-select name="category" id="category_name">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </x-select>
                                </div>
                                <div class="form-group mb-2">
                                    <x-input-label for="project_subcategory" value="Project SubCategory" />
                                    <x-select name="subcategory" id="project_subcategory">
                                        <option selected disabled>Select SubCategory</option>
                                        <option value="web">Web</option>
                                        <option value="mobile">Mobile</option>
                                        <option value="desktop">Desktop</option>
                                    </x-select>
                                </div>
                                <div class="form-group">
                                    <label for="github_url" class="form-label fw-bold">GitHub URL</label>
                                    <x-text-input id="github_url" type="url" name="github_url" placeholder="GitHub URL" class="text-white"/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group my-3">
                                    <x-input-label for="project_description" value="Project Description" />
                                    <x-textarea name="description" id="project_description" rows="3" placeholder="Project Description"></x-textarea>
                                </div>
                                <div class="form-group">
                                    <x-input-label for="project_image" value="Project Image" />
                                    <x-text-input type="file" name="image" id="project_image" accept="image/*" />
                                </div>
                            </div>
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
                            <th class="text-center text-white">Image</th>
                            <th class="text-center text-white">Category</th>
                            <th class="text-center text-white">Tags</th>
                            <th class="text-center text-white">Url</th>
                            <th class="text-center text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            @php
                                $tags = json_decode($project->tags, true);
                            @endphp
                            <tr>
                                <td class="text-center">{{$project->name}}</td>
                                <td class="text-center">
                                    <img src="{{ asset($project->image) }}" width="50" alt="Project-img">
                                </td>
                                <td class="text-center">{{$project->category}}</td>
                                <td class="text-center">
                                    @if(is_array($tags))
                                        @foreach($tags as $tag)
                                            <span class="badge bg-primary px-2 py-1 me-1">{{ $tag['value'] }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ $project->link }}">
                                        <i data-feather="link"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_project_{{$project->id}}">
                                        <i class="fa-solid fa-pen-to-square fa-xl text-muted py-1"></i>
                                    </button>
                                    <div class="modal fade" id="edit_project_{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('projects.update')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id" value="{{$project->id}}">
                                                        @php
                                                            $decodedTags = collect(json_decode($project->tags, true))->pluck('value')->implode(',');
                                                        @endphp
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-2">
                                                                    <x-input-label for="project_name" value="Project Name" class="form-label" />
                                                                    <x-text-input id="project_name" type="text" name="name" value="{{$project->name}}"/>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <x-input-label for="project_url" value="Project Url" />
                                                                    <x-text-input id="project_url" type="url" name="link" value="{{$project->link}}"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <x-input-label for="tags" value="Project Tags" />
                                                                    <x-text-input id="tags-{{ $project->id }}" type="text" name="tags" value="{{ $decodedTags }}" data-project-id="{{ $project->id }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-2">
                                                                    <x-input-label for="category_name" value="Category Name" />
                                                                    <x-select name="category" id="category_name">
                                                                        <option selected disabled>Select Category</option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->name }}" {{$category->name === $project->category ? 'selected' : ''}}>{{ $category->name }}</option>
                                                                        @endforeach
                                                                    </x-select>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <x-input-label for="project_subcategory" value="Project SubCategory" />
                                                                    <x-select name="subcategory" id="project_subcategory">
                                                                        <option selected disabled>Select SubCategory</option>
                                                                        <option value="web" {{$project->subcategory === 'web' ? 'selected' : ''}}>Web</option>
                                                                        <option value="mobile" {{$project->subcategory === 'mobile' ? 'selected' : ''}}>Mobile</option>
                                                                        <option value="desktop" {{$project->subcategory === 'desktop' ? 'selected' : ''}}>Desktop</option>
                                                                    </x-select>
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <label for="github_url" class="form-label fw-bold">GitHub URL</label>
                                                                    <x-text-input id="github_url" type="url" name="github_url" value="{{$project->github_url}}" placeholder="GitHub URL" class="text-white"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group my-3">
                                                                    <x-input-label for="project_description" value="Project Description" />
                                                                    <x-textarea name="description" id="project_description" rows="3" placeholder="Project Description" value="{{$project->description}}"></x-textarea>
                                                                </div>
                                                                @isset($project->image)
                                                                    <div class="view-image my-3">
                                                                        <img src="{{asset($project->image)}}" width="80" class="rounded" alt="{{$project->name}}">
                                                                    </div>
                                                                @endisset
                                                                <div class="form-group mt-2">
                                                                    <x-input-label for="project_image" value="Project Image" />
                                                                    <x-text-input type="file" name="image" id="project_image" value="{{$project->image}}" accept="image/*" />
                                                                </div>
                                                            </div>
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
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_project_{{$project->id}}">
                                        <i class="fa-solid fa-trash-can fa-xl text-muted py-1"></i>
                                    </button>
                                    <div class="modal fade" id="delete_project_{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('projects.destroy', $project->id)}}" method="post">
                                                        @csrf
                                                        @method('GET')
                                                        <h1 class="text-center my-2">Are you sure you want to delete this project?</h1>
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
</x-app-layout>
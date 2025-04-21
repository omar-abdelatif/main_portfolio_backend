@section('title')
    Skills
@endsection
@section('breadcrumb-title')
    <h3>Skills</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Skills</li>
@endsection

@section('modals')
    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#new-skill">New Skill</button>
    <div class="modal fade" id="new-skill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('skills.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Skill Name</label>
                            <input type="text" name="name" class="form-control text-white">
                        </div>
                        <div class="form-group mb-3">
                            <label>Skill Level</label>
                            <input type="number" name="level" class="form-control text-white">
                        </div>
                        <div class="form-group">
                            <label>Skill Image</label>
                            <input type="file" name="image" class="form-control text-white">
                        </div>
                        <div class="modal-footer mt-3">
                            <x-secondary-button data-bs-dismiss="modal" class="rounded">Close</x-secondary-button>
                            <x-primary-button type="submit" class="btn btn-primary">Confirm</x-primary-button>
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
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped text-center align-middle" data-page-length="10">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skills as $skill)
                                    <tr>
                                        <td>{{ $skill->name }}</td>
                                        <td>
                                            <img src={{ asset($skill->image)}} width="50" alt="{{$skill->name}} Image" />
                                        </td>
                                        <td>{{ $skill->level}}%</td>
                                        <td>
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_skill_{{$skill->id}}">
                                                <i class="fa-solid fa-pen-to-square fa-xl text-muted py-1"></i>
                                            </button>
                                            <div class="modal fade" id="edit_skill_{{$skill->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Skill</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('skills.update', $skill->id)}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$skill->id}}">
                                                                <div class="form-group mb-3">
                                                                    <label>Skill Name</label>
                                                                    <input type="text" name="name" class="form-control text-white" value="{{$skill->name}}">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label>Skill Level</label>
                                                                    <input type="number" name="level" class="form-control text-white" value="{{$skill->level}}">
                                                                </div>
                                                                @isset($skill->image)
                                                                    <img src="{{asset($skill->image)}}" class="my-3" width="80" alt="{{$skill->name}} Image" />
                                                                @endisset
                                                                <div class="form-group">
                                                                    <label>Skill Image</label>
                                                                    <input type="file" name="image" value="{{$skill->image}}" class="form-control text-white">
                                                                </div>
                                                                <div class="modal-footer mt-3">
                                                                    <x-secondary-button data-bs-dismiss="modal" class="rounded">Close</x-secondary-button>
                                                                    <x-primary-button type="submit" class="btn btn-primary">Confirm</x-primary-button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_skill_{{$skill->id}}">
                                                <i class="fa-solid fa-trash fa-xl text-muted py-1"></i>
                                            </button>
                                            <div class="modal fade" id="delete_skill_{{$skill->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Skill</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('skills.destroy', $skill->id)}}" method="get">
                                                                @csrf
                                                                <h1 class="text-center">Are You Sure You Want To Delete This Skill?</h1>
                                                                <div class="modal-footer mt-3">
                                                                    <x-secondary-button data-bs-dismiss="modal" class="rounded">Close</x-secondary-button>
                                                                    <x-primary-button type="submit" class="btn btn-primary">Confirm</x-primary-button>
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
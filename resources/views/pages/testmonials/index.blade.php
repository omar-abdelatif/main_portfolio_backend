@section('title')
    Testmonials
@endsection
@section('breadcrumb-title')
    <h3>Testmonials</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Testmonials</li>
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
                            <x-text-input id="reviewer_name" type="text" name="name" placeholder="Project Name" class="text-white"/>
                        </div>
                        <div class="form-group mb-3">
                            <x-input-label for="reviewer_image" value="Reviewer Image" />
                            <x-text-input type="file" name="image" id="reviewer_image" accept="image/*" />
                        </div>
                        <div class="form-group mb-3">
                            <x-input-label for="project_description" value="Project Description" />
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
</x-app-layout>
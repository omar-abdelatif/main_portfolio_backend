@section('title')
    Dashboard
@endsection

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

<x-app-layout>
    <div class="row justify-content-center align-item-center">
        <div class="col-lg-4">
            <x-card title="Total Projects" count="{{$projectCount}}" icon="clipboard" />
        </div>
        <div class="col-lg-4">
            <x-card title="Total Categories" count="{{$categoryCount}}" icon="settings" />
        </div>
        <div class="col-lg-4">
            <x-card title="Total Plans" count="{{$planCount}}" icon="settings" />
        </div>
    </div>
</x-app-layout>
@section('title')
    Settings
@endsection
@section('breadcrumb-title')
    <h3>Settings</h3>
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Settings</li>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select/bootstrap-select.min.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/bootstrap-multiselectsplitter.min.js') }}"></script>
    <script src="{{ asset('assets/js/select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-setting.js') }}"></script>
@endsection
<x-app-layout>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                sweetalertError($error);
            @endphp
        @endforeach
    @endif
    <div class="container-fluid main-setting">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dashboard Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-lg-3 g-4">
                            <div class="col-lg-3 col-12">
                                <div class="nav flex-lg-column nav-pills nav-primary" id="ver-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="ver-pills-api-tab" data-bs-toggle="pill" href="#ver-pills-api" aria-selected="true" role="tab">Api</a>
                                    <a class="nav-link" id="ver-pills-social-tab" data-bs-toggle="pill" href="#ver-pills-social" aria-selected="false" role="tab">Social Links</a>
                                    <a class="nav-link" id="ver-pills-payment-tab" data-bs-toggle="pill" href="#ver-pills-payment" aria-selected="false" role="tab">Payment Methods</a>
                                    <a class="nav-link" id="ver-pills-about-tab" data-bs-toggle="pill" href="#ver-pills-about" aria-selected="false" role="tab">About</a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-12">
                                <div class="tab-content" id="ver-pills-tabContent">
                                    <div class="tab-pane fade show active" id="ver-pills-api">
                                        <div class="row mb-0">
                                            <label class="col-md-3 mt-2 mb-0">Api Key</label>
                                            <div class="col-md-9">
                                                <form action="{{route('settings.api.update')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $apiKey->id }}">
                                                    <input class="form-control" type="text" name="api_key" placeholder="Create Api Key" value="{{ $apiKey->key }}" readonly>
                                                    <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Generate New Api Key</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ver-pills-about">
                                        <form action="{{route('about.update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="developer_name" class="form-label">Developer Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Developer Name" value=""/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_name" class="form-label">Developer Email</label>
                                                <input type="email" class="form-control" id="name" name="email" placeholder="Enter Developer Email" value=""/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_position" class="form-label">Developer Position</label>
                                                <input type="text" name="position" id="postion" class="form-control" placeholder="Developer Position" value="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_position" class="form-label">Developer Nationality</label>
                                                <input type="text" name="nationality" id="postion" class="form-control" placeholder="Developer Nationality" value="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_phone" class="form-label">Developer Phone</label>
                                                <input type="number" name="mobile" id="postion" class="form-control" placeholder="Developer Phone" value="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="aboutt-img" class="form-label fw-bold">About Image</label>
                                                <input type="file" name="about_img" id="about-img" class="form-control" accept="image/*" value="">
                                            </div>
                                            <div class="form-footer">
                                                <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="ver-pills-social">
                                        <form action="{{route('social.update')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @php
                                                $socialLinks = ['facebook', 'github', 'linkedin', 'whatsapp'];
                                            @endphp
                                            @foreach ($socialLinks as $platform)
                                                @php
                                                    $data = $platforms[$platform] ?? null;
                                                @endphp
                                                <div class="form-group mb-3">
                                                    <label for="{{$platform}}_url" class="form-label">{{ ucfirst($platform) }} URL</label>
                                                    <input type="text" class="form-control" id="{{$platform}}_url" name="social_{{ $platform }}" placeholder="Enter {{ ucfirst($platform) }} URL" value="{{ old('social_'.$platform, $data->url ?? '') }}"/>
                                                </div>
                                                @if(isset($data) && $data->platform_icon)
                                                    <div class="mb-2 text-center">
                                                        <label class="form-label">الصورة الحالية:</label><br>
                                                        <img src="{{ $data->platform_icon }}" alt="{{ $platform }} icon" style="height: 60px;">
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label for="{{$platform}}_image" class="form-label">{{ ucfirst($platform) }} Image</label>
                                                    <input type="file" name="{{$platform}}_image" id="{{$platform}}_image" value="{{ isset($data) && $data->platform_icon ? $data->platform_icon : '' }}" class="form-control" accept="image/*">
                                                </div>
                                                <div class="form-check form-switch mb-1">
                                                    <label class="form-check-label" for="{{ $platform }}_switch">
                                                        Active {{ ucfirst($platform) }}
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" id="{{ $platform }}_switch" name="{{ $platform }}_status" {{ (isset($data) && $data->status == 'active') ? 'checked' : '' }}/>
                                                </div>
                                                <hr class="rounded-pill" style="border-width: 5px; border-color: #f1f1f1"/>
                                            @endforeach
                                            <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Save</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="ver-pills-payment">
                                        <form action="{{route('payment.update')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @php
                                                $payments = ['paypal', 'instapay', 'vfCash', 'fawry'];
                                            @endphp
                                            @foreach ($payments as $payment)
                                                @php
                                                    $data = $paymentMethods[$payment] ?? null;
                                                @endphp
                                                <div class="form-group mb-3">
                                                    <label for="{{$payment}}" class="form-label">{{ ucfirst($payment) }}</label>
                                                    <input type="text" class="form-control" id="{{$payment}}" name="payment_{{ $payment }}" placeholder="Enter {{ ucfirst($payment) }} Value"  value="{{ old('payment_'.$payment, $data->methods_value ?? '') }}"/>
                                                </div>
                                                @if(isset($data) && $data->methods_icon)
                                                    <div class="mb-2 text-center">
                                                        <label class="form-label">الصورة الحالية:</label><br>
                                                        <img src="{{ $data->methods_icon }}" alt="{{ $payment }} icon" style="height: 60px;">
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label for="{{$payment}}_image" class="form-label">{{ ucfirst($payment) }} Image</label>
                                                    <input type="file" name="{{$payment}}_image" id="{{$payment}}_image" value="{{ isset($data) && $data->methods_icon ? $data->methods_icon : '' }}" class="form-control" accept="image/*">
                                                </div>
                                                <div class="form-check form-switch mb-1">
                                                    <label class="form-check-label" for="{{ $payment }}_switch">
                                                        Activate
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" id="{{ $payment }}_switch" name="active_{{ $payment }}" {{ (isset($data) && $data->methods_status == 'active') ? 'checked' : '' }}/>
                                                </div>
                                                <hr class="rounded-pill" style="border-width: 5px; border-color: #f1f1f1"/>
                                            @endforeach
                                            <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
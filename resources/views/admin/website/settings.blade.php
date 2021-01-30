@extends('adminlte::page')

@section('title_postfix', '| website settings')

@section('content_header')
<h1 class="m-0 text-dark">Website Settings</h1>
@stop

@section('content')
<div class="card">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Change Site name
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.website.change_site_name') }}" method="post">
                        @csrf
                        @method('put')

                        <x-adminlte-input name="name" label="name" placeholder="Name" label-class="text-lightblue"
                            value="{{ old('name' , getSiteName()) }}">
                        </x-adminlte-input>

                        <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Save" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Change Logos
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.website.change_logos') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ getSiteNavLogo() }}" class="img-thumbnail" style="height: 100px">
                            </div>
                            <div class="col-md-8">
                                <x-adminlte-input-file name="nav_logo" size='sm' placeholder="Choose a Navbar Logo...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-file>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ getSiteFooterLogo() }}" class="img-thumbnail" style="height: 100px">
                            </div>
                            <div class="col-md-8">
                                <x-adminlte-input-file name="footer_logo" size='sm'
                                    placeholder="Choose a Footor Logo...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-file>
                            </div>
                        </div>


                        <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Site Lock (current status :
                    @if(isSiteIsLocked())
                    <span style="color: red;font-weight:bold"><i class="fa fa-lock" aria-hidden="true"></i>
                        {{ siteLockType() }} </span>
                    @else
                    <span style="color: green;font-weight:bold">Open</span>
                    @endif
                    )
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.website.status') }}" method="post">
                        @csrf
                        @method('put')

                        <x-adminlte-select name="status">
                            <option>Site Status</option>
                            @if(isSiteIsLocked())
                            <option value="unlock">Unlock</option>
                            @endif
                            <option value="maintenance">In maintenance</option>
                            <option value="vacation">In vacation</option>
                        </x-adminlte-select>

                        <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Save" />
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Change Social Links
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.website.social_links') }}" method="post">
                        @csrf
                        @method('put')

                        <x-adminlte-input name="facebook" label="facebook" placeholder="facebook" type="url"
                            label-class="text-lightblue" value="{{ old('facebook' , socialSettings()->facebook) }}">
                        </x-adminlte-input>

                        <x-adminlte-input name="instagram" label="instagram" placeholder="instagram" type="url"
                            label-class="text-lightblue" value="{{ old('instagram' , socialSettings()->instagram) }}">
                        </x-adminlte-input>

                        <x-adminlte-input name="pinterest" label="pinterest" placeholder="pinterest" type="url"
                            label-class="text-lightblue" value="{{ old('pinterest' , socialSettings()->pinterest) }}">
                        </x-adminlte-input>

                        <x-adminlte-input name="youtube" label="youtube" placeholder="youtube" type="url"
                            label-class="text-lightblue" value="{{ old('youtube' , socialSettings()->youtube) }}">
                        </x-adminlte-input>

                        <x-adminlte-input name="twitter" label="twitter" placeholder="twitter" type="url"
                            label-class="text-lightblue" value="{{ old('twitter' , socialSettings()->twitter) }}">
                        </x-adminlte-input>

                        <x-adminlte-input name="tiktok" label="tiktok" placeholder="tiktok" type="url"
                            label-class="text-lightblue" value="{{ old('tiktok' , socialSettings()->tiktok) }}">
                        </x-adminlte-input>


                        <x-adminlte-input name="snapchat" label="snapchat" placeholder="snapchat" type="url"
                            label-class="text-lightblue" value="{{ old('snapchat' , socialSettings()->snapchat) }}">
                        </x-adminlte-input>

                        <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

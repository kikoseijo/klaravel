@php
    $title = 'Route listing (kLaravel)';
@endphp

@extends(config('ksoft.module.crud.layout', 'klaravel::layouts.crud'))

@section('content')
    <div class="{{config('ksoft.style.crud_container_wrapper','container -body-block pb-5')}}">
        @card(['title' => 'List routes', 'reload_btn' => true])
            @include('klaravel::ui.tables.actions-menu', [
                'model_name' => 'kLara.routes',
                'hide_add_menu' => true,
                'hide_per_page' => true,
            ])

            @if (count($routes)>0)
                <div class="text-muted text-center py-3">
                    Found <strong>{{count($routes)}} routes</strong>.
                </div>
            @endif

            <div class="table-responsive my-4">
                @includeIf('klaravel::admin.routes-table')
            </div>
        @endcard
    </div>
@endsection

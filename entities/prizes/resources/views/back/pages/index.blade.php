@extends('admin::back.layouts.app')

@php
    $title = 'Призы';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.social-contest.prizes::back.partials.breadcrumbs.index')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{ route('back.social-contest.prizes.create') }}" class="btn btn-primary btn-sm">Добавить</a>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'table table-striped table-bordered table-hover dataTable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:datatables_prizes_index')
    {!! $table->scripts() !!}
@endpushonce

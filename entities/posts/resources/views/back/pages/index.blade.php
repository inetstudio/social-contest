@php
    /** @var Yajra\DataTables\Html\Builder $table */

    $title = 'Посты';
@endphp

@extends('admin::back.layouts.app')

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.social-contest.posts::back.partials.breadcrumbs.index')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="row view active" id="social_contest_posts">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#add_socialPost_modal">Добавить</button>
                        <div class="ibox-tools">
                            <a href="{{ route('back.social-contest.posts.export') }}" class="btn btn-xs btn-primary">Экспорт</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'table table-striped table-bordered table-hover dataTable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:datatables_social_contest_posts_index')
    {!! $table->scripts() !!}
@endpushonce

@include('admin.module.social-contest.posts::back.modals.add_post')

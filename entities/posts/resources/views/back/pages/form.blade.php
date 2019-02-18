@inject('statusesService', 'InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract')

@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Редактирование поста' : '';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.social-contest.posts::back.partials.breadcrumbs.form')
    @endpush

    <div class="row m-sm">
        <a class="btn btn-white" href="{{ route('back.social-contest.posts.index') }}">
            <i class="fa fa-arrow-left"></i> Вернуться назад
        </a>
        <div class="bg-{{ $item->status->color_class }} p-xs b-r-sm pull-right">{{ $item->status->name }}</div>
    </div>

    <div class="row m-b-lg m-t-lg m-sm">
        <div class="col-md-6">
            <div class="profile-image">

                @include('admin.module.social-contest.posts::back.partials.preview', [
                    'item' => $item,
                    'conversion' => 'form'
                ])

            </div>
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                            {{ $item->social->user->nickname }}
                        </h2>
                        <h4><a href="{{ $item->social->user->url }}" target="_blank">Открыть профиль</a></h4>
                        <h4><a href="{{ $item->social->url }}" target="_blank">Перейти к посту</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">

        {!! Form::info() !!}

            {!! Form::open(['url' => (! $item->id) ? route('back.social-contest.posts.store') : route('back.social-contest.posts.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
    
                @if ($item->id)
                    {{ method_field('PUT') }}
                @endif

                {!! Form::hidden('post_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

                {!! Form::hidden('post_type', get_class($item), ['id' => 'object-type']) !!}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group float-e-margins" id="mainAccordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain" aria-expanded="true">Основная информация</a>
                                    </h5>
                                </div>
                                <div id="collapseMain" class="panel-collapse collapse in" aria-expanded="true">
                                    <div class="panel-body">

                                        {!! Form::dropdown('status_id', $item->status_id, [
                                            'label' => [
                                                'title' => 'Статус',
                                            ],
                                            'field' => [
                                                'class' => 'select2 form-control',
                                                'data-placeholder' => 'Выберите статус',
                                                'style' => 'width: 100%',
                                            ],
                                            'options' => [
                                                'values' => [null => ''] + $statuses = $statusesService->getAllItems()->pluck('name', 'id')->toArray(),
                                            ],
                                        ]) !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
            {!! Form::buttons('', '', ['back' => 'back.social-contest.posts.index']) !!}

        {!! Form::close()!!}

    </div>
@endsection

@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Просмотр приза' : 'Создание приза';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.social-contest.prizes::back.partials.breadcrumbs.form')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <a class="btn btn-sm btn-white" href="{{ route('back.social-contest.prizes.index') }}">
                    <i class="fa fa-arrow-left"></i> Вернуться назад
                </a>
            </div>
        </div>

        {!! Form::info() !!}

            {!! Form::open(['url' => (! $item->id) ? route('back.social-contest.prizes.store') : route('back.social-contest.prizes.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data']) !!}
    
            @if ($item->id)
                {{ method_field('PUT') }}
            @endif
    
            {!! Form::hidden('prize_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}
    
            {!! Form::hidden('prize_type', get_class($item), ['id' => 'object-type']) !!}

            <div class="ibox">
                <div class="ibox-title">
                    {!! Form::buttons('', '', ['back' => 'back.social-contest.prizes.index']) !!}
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-group float-e-margins" id="mainAccordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain" aria-expanded="true">Основная информация</a>
                                        </h5>
                                    </div>
                                    <div id="collapseMain" class="collapse show" aria-expanded="true">
                                        <div class="panel-body">

                                            {!! Form::string('name', $item->name, [
                                                'label' => [
                                                    'title' => 'Название',
                                                ],
                                            ]) !!}

                                            {!! Form::string('alias', $item->alias, [
                                                'label' => [
                                                    'title' => 'Алиас',
                                                ],
                                            ]) !!}

                                            {!! Form::wysiwyg('description', $item->description, [
                                                'label' => [
                                                    'title' => 'Описание',
                                                ],
                                                'field' => [
                                                    'class' => 'tinymce',
                                                    'id' => 'description',
                                                    'hasImages' => false,
                                                ],
                                            ]) !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-footer">
                    {!! Form::buttons('', '', ['back' => 'back.social-contest.prizes.index']) !!}
                </div>
            </div>

        {!! Form::close()!!}

    </div>
@endsection

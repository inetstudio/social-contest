{!! Form::open(['url' => route('back.social-contest.posts.update', [$item['id']]), 'id' => 'social_contest_post_form']) !!}
    @if ($item['id'])
        {{ method_field('PUT') }}
    @endif

    {!! Form::hidden('id', $item['id'] ?? 0, ['id' => 'object-id']) !!}

    {!! Form::hidden('type', get_class($item), ['id' => 'object-type']) !!}

    <div class="row m-b-md">
        <div class="col-lg-12">
            <span class="btn btn-sm btn-{{ $item['status']['color_class'] }} float-right">{{ $item['status']['name'] }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Пост</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="m-b-lg">
                                <p><strong>Социальная сеть:</strong> {{ $item['social']['social_name'] }}</p>
                                <p><strong>Тип поста:</strong> {{ $item['social']['media_type'] }}</p>
                                <p><strong>Пользователь:</strong> <a href="{{ $item['social']['user']['url'] }}" target="_blank">{{ $item['social']['user']['nickname'] }}</a></p>
                                <p><strong>Пост:</strong> <a href="{{ $item['social']['url'] }}" target="_blank">Перейти</a></p>
                                <p><strong>ID поста на сайте:</strong> <span id="uuid-{{ $item['id'] }}">{{ $item['uuid'] }}</span></p>
                                <p><strong>Содержимое:</strong><br/>{!! $item['social']['caption'] !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            @include('admin.module.social-contest.posts::back.partials.preview', [
                                'item' => $item,
                                'conversion' => 'index'
                            ])
                        </div>
                    </div>
                    <div class="m-b-lg">
                        @include('admin.module.social-contest.posts::back.modals.additional_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox border-bottom collapsed">
                <div class="ibox-title">
                    <h5>Призы</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="display: none;">
                    <div>
                        <social-contest-prizes-list
                            v-bind:prizes-prop="{{ json_encode($item['prizes']) }}"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

{!! Form::close()!!}

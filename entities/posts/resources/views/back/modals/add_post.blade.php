@pushonce('modals:add_socialpost')
    <div id="add_socialPost_modal" class="modal inmodal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                    <h4 class="modal-title">Создание поста</h4>
                </div>

                <div class="modal-body">
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <form method="post" action="{{ route('back.social-contest.posts.add') }}">

                            {!! Form::dropdown('social_network', '', [
                                'label' => [
                                    'title' => 'Социальная сеть',
                                ],
                                'field' => [
                                    'class' => 'select2-drop form-control',
                                    'data-placeholder' => 'Выберите социальную сеть',
                                    'style' => 'width: 100%',
                                ],
                                'options' => [
                                    'values' => [
                                        null => '',
                                        'instagram' => 'Instagram',
                                        'vkontakte' => 'Вконтакте',
                                    ],
                                ],
                            ]) !!}

                            {!! Form::string('social_post_link', '', [
                                'label' => [
                                    'title' => 'Ссылка на пост',
                                ],
                            ]) !!}

                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Отмена</button>
                    <button class="btn btn-primary add" type="submit">Добавить</button>
                </div>
            </div>
        </div>
    </div>
@endpushonce

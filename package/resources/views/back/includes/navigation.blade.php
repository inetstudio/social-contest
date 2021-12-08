<li class="{{ isActiveRoute('back.social-contest.*', 'mm-active') }}">
    <a href="#" aria-expanded="false"><i class="fa fa-hashtag"></i> <span class="nav-label">Конкурс по постам</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        @include('admin.module.social-contest.posts::back.includes.package_navigation')
        @include('admin.module.social-contest.prizes::back.includes.package_navigation')
        @include('admin.module.social-contest.statuses::back.includes.package_navigation')
    </ul>
</li>

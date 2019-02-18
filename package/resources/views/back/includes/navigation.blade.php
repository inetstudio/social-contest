<li class="{{ isActiveRoute('back.social-contest.*') }}">
    <a href="#"><i class="fa fa-hashtag"></i> <span class="nav-label">Конкурс по постам</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        @include('admin.module.social-contest.posts::back.includes.package_navigation')
        @include('admin.module.social-contest.statuses::back.includes.package_navigation')
        @include('admin.module.social-contest.stages::back.includes.package_navigation')
        @include('admin.module.social-contest.prizes::back.includes.package_navigation')
        @include('admin.module.social-contest.points::back.includes.package_navigation')
        @include('admin.module.social-contest.tags::back.includes.package_navigation')
</ul>
</li>

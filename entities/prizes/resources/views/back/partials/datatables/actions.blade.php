<div class="btn-nowrap">
    <a href="{{ route('back.social-contest.prizes.edit', [$item->id]) }}" class="btn btn-xs btn-default m-r-xs"><i class="fa fa-pencil-alt"></i></a>
    <a href="#" class="btn btn-xs btn-danger delete" data-url="{{ route('back.social-contest.prizes.destroy', [$item->id]) }}"><i class="fa fa-times"></i></a>
</div>

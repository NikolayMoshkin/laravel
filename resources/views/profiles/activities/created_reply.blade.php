@component('profiles.activities.activity')
    @slot('heading')
        {{$activity->subject->created_at->diffForHumans()}} Ответ на пост <a href="{{$activity->subject->thread->path()}}">{{$activity->subject->thread->title}}</a>
    @endslot

    @slot('body')
        {{$activity->subject->body}}
    @endslot
@endcomponent

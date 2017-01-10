<div class="card card-user card-clickable card-clickable-over-content cardItem">
    <div class="card-heading heading-full">
        <div class="user-image coverImgContainer">
            @if($card->image_id == null)
                <img class="coverImg" src="{{asset('assets/img/memori.png')}}">
            @else
                <img class="coverImg" src="{{url('data/images/' . $card->image->imageCategory->category .  '/' . $card->image->file_path)}}">
            @endif
        </div>
        @if($user != null)
            @if($gameFlavor->accessed_by_user)
                <div class="clickable-button">
                    <div class="layer bg-green"></div>
                    <a class="btn btn-floating btn-green initial-position floating-open"><i class="fa fa-cog" aria-hidden="true"></i></a>
                </div>

                <div class="layered-content bg-green">
                    <div class="overflow-content">
                        <ul class="borderless">

                            <li><a class="btn btn-flat btn-ripple editCard"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></li>
                            {{--@if($user->isAdmin())--}}
                                {{--@if(!$gameVersion->published)--}}
                                    {{--<li><a href="{{url('gameVersion/unpublish', $gameVersion->id)}}" class="btn btn-flat btn-ripple"><i class="fa fa-check" aria-hidden="true"></i> Publish</a></li>--}}
                                {{--@else--}}
                                    {{--<li><a href="{{url('gameVersion/unpublish', $gameVersion->id)}}" class="btn btn-flat btn-ripple"><i class="fa fa-ban" aria-hidden="true"></i> Unpublish</a></li>--}}
                                {{--@endif--}}
                            {{--@endif--}}
                        </ul>
                    </div><!--.overflow-content-->
                    <div class="clickable-close-button">
                        <a class="btn btn-floating initial-position floating-close"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </div>
                </div>
            @endif
        @endif
    </div><!--.card-heading-->

    {{--<div class="card-body">--}}
        {{--<h3 class="gameVersionTitle">--}}
            {{--<a href="{{route('showCardsForGameFlavor', $gameVersion->id)}}"> {{$gameVersion->name}}</a>--}}
            {{--@if($user != null)--}}
                {{--@if($user->isAdmin())--}}
                    {{--@if(!$gameVersion->published)--}}
                        {{--<i class="fa fa-exclamation-triangle statusIcon" aria-hidden="true" style="color: orangered" title="This game is not published yet."></i>--}}
                    {{--@else--}}
                        {{--<i class="fa fa-check-circle statusIcon" aria-hidden="true" style="color: forestgreen" title="Published game."></i>--}}
                    {{--@endif--}}
                {{--@endif--}}
            {{--@endif--}}
        {{--</h3>--}}
        {{----}}

    {{--</div><!--.card-body-->--}}

    <div class="card-footer">
        <div class="cardSound">
            @if($card->sound != null)
                <audio controls>
                    <source src="{{url('data/sounds/' . $card->sound->soundCategory->category .  '/' . $card->sound->file_path)}}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            @endif
        </div>
    </div><!--.card-footer-->

</div><!--.card-->
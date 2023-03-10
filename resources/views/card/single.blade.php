<div class="card card-user card-clickable card-clickable-over-content cardItem">
    <div class="card-heading heading-full">
        <div class="user-image coverImgContainer">
            @if($card->image_id == null)
                <img loading="lazy" class="coverImg" src="{{asset('assets/img/memori.png')}}">
            @else
                <img loading="lazy" class="coverImg"
                     src="{{route('resolveDataPath', ['filePath' => $card->image->file->file_path])}}">
            @endif
        </div>
        @if($user != null)
            @if($gameFlavor->accessed_by_user)
                <div class="clickable-button">
                    <div class="layer bg-green"></div>
                    <a class="btn btn-floating btn-green initial-position floating-open"><i class="fa fa-cog"
                                                                                            aria-hidden="true"></i></a>
                </div>

                <div class="layered-content bg-green">
                    <div class="overflow-content">
                        <ul class="borderless">
                            <li><a data-cardId="{{$card->id}}" class="btn btn-flat btn-ripple editCardBtn"><i
                                            class="fa fa-pencil" aria-hidden="true"></i>
                                    {!! __('messages.edit') !!}</a></li>
                        </ul>
                    </div><!--.overflow-content-->
                    <div class="clickable-close-button">
                        <a class="btn btn-floating initial-position floating-close"><i class="fa fa-times"
                                                                                       aria-hidden="true"></i></a>
                    </div>
                </div>
            @endif
        @endif
    </div><!--.card-heading-->

    <div class="card-footer">
        <div class="cardSound">
            @if($card->sound != null)
                <audio controls>
                    <source src="{{route('resolveDataPath', ['filePath' => $card->sound->file->file_path])}}"
                            type="audio/mpeg">
                    <source src="{{route('resolveDataPath', ['filePath' => $card->sound->file->file_path])}}"
                            type="audio/wav">
                    {!! __('messages.sound_browser_no_support') !!}
                </audio>
            @endif
        </div>
    </div><!--.card-footer-->

</div><!--.card-->

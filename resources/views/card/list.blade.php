@foreach($cards as $card)
    <div class="col-md-6 p-0 padding-right-20 margin-bottom-10">
        @include('card.single', ['card' => $card, 'user' => \Illuminate\Support\Facades\Auth::user()])
    </div>
@endforeach

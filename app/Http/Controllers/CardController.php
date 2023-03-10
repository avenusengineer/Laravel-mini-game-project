<?php

namespace App\Http\Controllers;

use App\BusinessLogicLayer\managers\CardManager;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class CardController handles the requests tied to the @see Card class
 * @package App\Http\Controllers
 */
class CardController extends Controller
{

    private $cardManager;
    /**
     * CardController constructor.
     */
    public function __construct(CardManager $cardManager) {
        $this->cardManager = $cardManager;
    }

    /**
     * Edits a @see Card model object
     *
     * @param Request $request the request containing the appropriate data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request) {
        //dd($request->all());
        $this->validate($request, [
            'card.*.image' => 'file|image|max:2000|mimes:jpeg,jpg,png,gif',
            'card.*.negative_image' => 'file|image|max:2000|mimes:jpeg,jpg,png,gif',
            'card.*.sound' => 'file|max:3000|mimetypes:audio/mpeg,audio/x-wav',
        ]);

        $input = $request->all();
        $gameFlavorId = $input['card'][1]['game_flavor_id'];

        try {
            $editedCard = $this->cardManager->editCard($gameFlavorId, $request->all());

            if($editedCard == null)
                throwException(new \Exception(trans('messages.error_generic')));
        }  catch (\Exception $e) {
            session()->flash('flash_message_failure', 'Error: ' . $e->getCode() . "  " .  $e->getMessage());
            return redirect()->back();
        }

        session()->flash('flash_message_success', trans('messages.game_card_created'));
        return redirect()->back();
    }

    public function storeUserAction(Request $request) {
        $input = $request->all();
        Storage::disk('local')->put('file.txt', $input['actions']);
        return '{"actions":' . $input['actions'] . '}';
    }
}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: pisaris
 * Date: 5/1/2017
 * Time: 12:25 μμ
 */

namespace App\BusinessLogicLayer\managers;


use App\Models\Card;
use App\Models\EquivalenceSet;
use App\StorageLayer\CardStorage;
use League\Flysystem\Exception;

class CardManager {

    private $cardStorage;
    private $imgManager;
    private $soundManager;

    /**
     * CardController constructor.
     */
    public function __construct() {
        $this->cardStorage = new CardStorage();
        $this->imgManager = new ImgManager();
        $this->soundManager = new SoundManager();
    }

//    public function getCardsForGameFlavor($gameVersionId) {
//        return $cards = $this->cardStorage->getCardsForGameFlavor($gameVersionId);
//    }

    public function createNewCard($input, $equivalenceSetId, $category) {
        //dd($input);
        $newCard = new Card();
        $newCard->label = $this->generateRandomString();
        $newCard->image_id = $this->imgManager->uploadCardImg($input['image']);
        $newCard->equivalence_set_id = $equivalenceSetId;
        $newCard->category = $category;
        if(isset($input['negative_image'])) {
            if ($input['negative_image'] != null)
                $newCard->negative_image_id = $this->imgManager->uploadCardImg($input['negative_image']);
        }

        $newCard->sound_id = $this->soundManager->uploadCardSound($input['sound']);
        return $this->cardStorage->saveCard($newCard);
    }


    /**
     * Generates and returns a random string
     *
     * @param int $length the length of the string
     * @return string the random string generated
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function addCardsToEquivalenceSet(array $createdCards, EquivalenceSet $newEquivalenceSet) {
        foreach ($createdCards as $createdCard) {
            $createdCard->equivalence_set_id = $newEquivalenceSet->id;
            $this->cardStorage->saveCard($createdCard);
        }
    }

    public function createCards(EquivalenceSet $newEquivalenceSet, array $input) {
        $index = 1;
        foreach ($input['card'] as $cardFields) {
            $newCard = $this->createNewCard($cardFields, $newEquivalenceSet->id, $index % 2 == 1 ? 'item' : 'item_equivalent');
            $index++;
            if ($newCard == null) {
                throw new Exception('Card creation failed');
            }
        }
        //TODO: discuss with ggianna
        if(count($input['card']) == 1) {
            $newCard = $this->createNewCard($input['card'][1], $newEquivalenceSet->id, 'item_equivalent');
            if ($newCard == null) {
                throw new Exception('Card creation failed');
            }
        }
    }


}
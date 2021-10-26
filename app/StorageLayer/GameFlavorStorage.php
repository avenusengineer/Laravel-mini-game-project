<?php
/**
 * Created by IntelliJ IDEA.
 * User: pisaris
 * Date: 3/1/2017
 * Time: 10:46 πμ
 */

namespace App\StorageLayer;


use App\Models\GameFlavor;
use Illuminate\Support\Facades\DB;

class GameFlavorStorage {

    protected $default_relationships = ['language', 'creator', 'gameVersion'];

    /**
     * Stores @param GameFlavor $gameFlavor the object to be stored
     * @return GameFlavor the newly created game version
     * @see GameFlavor object to DB
     */
    public function storeGameFlavor(GameFlavor $gameFlavor) {
        $gameFlavor->save();
        return $gameFlavor;
    }

    public function getGameFlavors($onlyPublished = true, $created_by_user_id = null) {
        DB::enableQueryLog();
        $query = DB::table('game_flavor');

        if ($onlyPublished)
            $query->where('published', true);
        if ($created_by_user_id)
            $query->where('creator_id', $created_by_user_id);

        return $query->join('language', 'game_flavor.lang_id', '=', 'language.id')
            ->join('users as creator', 'creator.id', '=', 'game_flavor.creator_id')
            ->join('game_version', 'game_version.id', '=', 'game_flavor.game_version_id')
            ->join('resource', 'resource.id', '=', 'game_flavor.cover_img_id')
            ->leftJoin("resource_file", function ($join) {
                $join->on("resource_file.game_flavor_id", "=", "game_flavor.id")
                    ->on("resource_file.resource_id", "=", "resource.id");
            })->select('game_flavor.*', 'creator.id as user_creator_id', 'creator.name as user_creator_name',
                'creator.email as user_creator_email', 'resource_file.file_path as cover_img_file_path',
                'language.id as language_id', 'language.flag_img_path as language_flag_img_path',
                'game_version.online as is_online')
            ->orderBy('game_flavor.created_at', 'desc')->get();
    }

    public function getGameFlavorById($id) {
        return GameFlavor::find($id);
    }

    public function getGameFlavorByGameIdentifier($gameIdentifier) {
        return GameFlavor::where([
            ['game_identifier', $gameIdentifier]
        ])->with($this->default_relationships)->first();

    }

    public function deleteGameFlavor(GameFlavor $gameFlavor) {
        $gameFlavor->delete();
    }

    public function gatGameFlavorsBySubmittedState($submittedState) {
        return GameFlavor::where([
            ['submitted_for_approval', '=', $submittedState],
        ])->with($this->default_relationships)->orderBy('created_at', 'desc')->get();
    }
}

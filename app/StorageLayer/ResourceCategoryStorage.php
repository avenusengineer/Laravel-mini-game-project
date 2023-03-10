<?php
/**
 * Created by IntelliJ IDEA.
 * User: pisaris
 * Date: 12/1/2017
 * Time: 4:39 μμ
 */

namespace App\StorageLayer;


use App\Models\ResourceCategory;

class ResourceCategoryStorage {

    public function getResourceCategoryByPath($name) {
        return ResourceCategory::where('path', $name)->first();
    }

    public function getResourceCategoryByPathForGameVersion($name, $gameVersionId) {
        return ResourceCategory::where(['path' => $name, 'game_version_id' => $gameVersionId])->first();
    }

    public function storeResourceCategory(ResourceCategory $resourceCategory) {
        $newResourceCategory = $resourceCategory->save();
        if ($newResourceCategory)
            return $resourceCategory->id;
        return null;
    }

    public function getResourceCategoriesForGameVersion($gameVersionId, $resourceTypeId, $langId = null) {
        //we exclude the game cover image, because it is added on game flavor form
        $query = ResourceCategory::where(['game_version_id' => $gameVersionId, 'type_id' => $resourceTypeId])
            ->where('description', '<>', 'img/game_cover');
        if ($langId)
            $query->with(['translations' => function ($q) use ($langId) {
                $q->where('lang_id', '=', $langId);
            }]);
        return $query->orderBy('order_id', 'asc')->get();
    }

}

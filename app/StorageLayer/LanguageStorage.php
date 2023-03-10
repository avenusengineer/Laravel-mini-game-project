<?php

namespace App\StorageLayer;
use App\Models\Language;

class LanguageStorage {

    public function getAllLanguages() {
        return Language::all();
    }

    public function getLanguageById($langId) {
        return Language::find($langId);
    }

    public function getLanguageByCode(string $lang_code) {
        return Language::where(['code' => $lang_code])->first();
    }
}

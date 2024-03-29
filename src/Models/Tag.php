<?php

namespace Magic\Models;

use Magic\Traits\MagicRelationship;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Trait
    use MagicRelationship;

    //
    protected $table = 'magic_tags';
    protected $fillable = ['name'];

    //
    static function getMagicRelationship($model, $magic = array()){

        //
        return $model->morphToMany(get_class(), 'taggable', 'magic_tags_rel');
    }

    // IMPORTANTE
    // O comando \Magic\Models\Tag::with('ref') não está funcionando
    public function ref()
    {
        $magic = \MagicRelationships::get($this->magic_id)->first();

        return $this->morphedByMany($magic['model'], 'taggable', 'magic_tags_rel');
    }


}

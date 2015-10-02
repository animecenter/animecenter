<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\Title
 *
 * @property integer $id
 * @property string $title
 * @property string $language
 * @property integer $titlable_id
 * @property string $titlable_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereTitlableId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereTitlableType($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Title whereDeletedAt($value)
 */
class Title extends Model
{
    //
}

<?php

namespace app\models\program;

use app\models\BaseSearchModel;

/**
 * Search represents the model behind the search form of `app\models\program\Program`.
 */
class SearchModel extends BaseSearchModel
{
    public $id;
    public $code;
    public $description;
    public $page;
    public $limit;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code', 'description'], 'safe'],
            [['page', 'limit'], 'integer'],
        ];
    }
}

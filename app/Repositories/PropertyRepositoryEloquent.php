<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Property;

/**
 * Class PropertyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PropertyRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Property::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    protected $fieldSearchable = [
        'name' => 'like',
        'bhk' => 'like',
        'location' => 'like',
        'price' => 'between'
    ];
}

<?php

    namespace App\Repository\Eloquent;
    use App\Models\Record;
    use App\Repository\RecordRepositoryInterface;

    class RecordRepository extends BaseRepository implements RecordRepositoryInterface
    {
         /**
         * @var Model
         */
        protected $model;

        /**
         * BaseRepository constructor
         * 
         * @param Model $model
         */

         public function __construct(Record $model)
         {
             $this->model = $model;
         }

    }

?>

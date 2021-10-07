<?php

    namespace App\Repository\Eloquent;

    use App\Repository\EloquentRepositoryInterface;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\QueryException;

    class BaseRepository implements EloquentRepositoryInterface
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

         public function __construct(Model $model)
         {
             $this->model = $model;
         }

         /**
          * @param array $columns
          * @param array $relations
          * @return Collection
          */
          public function all(array $columns = ['*'], array $relations = []): Collection
          {
              return $this->model->with($relations)->get($columns);
          } 

          /**
           * Create a Model
           * @param array $payload
           * @return Model
           */

           public function create(array $payload): ?Model
           {
               $model = $this->model->create($payload);
               return $model->fresh();
           }

           /**
           * Update a Model
           * @param array $payload
           * @return Model
           */
          public function update(string $modelId, array $payload): ?Model
          {
            $model = $this->model->find($modelId)->update($payload);
            return $this->model->find($modelId);
          }

           /**
           * Delete a Model
           * @param array $payload
           * @return bool
           */

          public function deleteById(int $modelId): bool
          {
            $model = $this->findById($modelId);
            return $model->delete();
          }

          /**
           * Show a Model
           * @param array $payload
           * @return bool
           */

          public function show(string $modelId): ?Model
          {
            $model = $this->model->find($modelId);
            return $model;
          }

           /**
           * Find a Model
           * @param array $payload
           * @return Model
           */

          public function findOne($attribute, $value, $columns = array('*')): ?Model
          {
            $model = $this->model->where($attribute, '=', $value)->first($columns);
            return $model;
          }

          /**
           * Find a Model
           * @param array $payload
           * @return Model
           */

           public function findById($modelId): ?Model
           {
             $model = $this->model->find($modelId);
             return $model;
           }


    }


?>
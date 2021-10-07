<?php 

    namespace App\Repository;

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;

    interface EloquentRepositoryInterface
    {
        /**
         * Get all Models
         * 
         * @param array $columns
         * @param array $relations
         * @return Collection
         */

         public function all(array $columns = ['*'], array $relations = []): Collection;

         /**
          * Create a model
          * @param array $payload
          * @return Model
          */
          public function create(array $payload): ?Model;

          /**
           *  Update existing Model
           * @param array $payload
           * @return bool
           */
          public function update(string $modelId, array $payload): ?Model;

          /**
           *  Delete model by id
           * @param int $modelId
           * @return bool
           */

          public function deleteById(int $modelId): bool;

           /**
           *  View model by id
           * @param int $modelId
           * @return bool
           */

          public function show(string $modelId): ?Model;

          /**
           *  View model by id
           * @param int $modelParam
           * @return Model
           */

          public function findOne(string $attribute, string $value): ?Model;

          /**
           *  View model by id
           * @param int $modelId
           * @return Model
           */

          public function findById(string $modelId): ?Model;



    }

?>
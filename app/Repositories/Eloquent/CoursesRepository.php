<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CoursesRepositoryInterface;
use App\Courses;

class CoursesRepository extends AbstractRepository implements CoursesRepositoryInterface
{
    protected $model = Courses::class;

    public function create(array $data): bool
    {
        $user = Auth()->user();
        $data['user_id'] = $user->id;
        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id): bool
    {
        $register = $this->find($id);
        if ($register) {
            $user = Auth()->user();
            $data['user_id'] = $user->id;
            return (bool) $register->update($data);
        } else {
            return false;
        }
    }
}

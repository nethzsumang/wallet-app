<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * BaseRepository class
 * @author Kenneth Sumang
 */
class BaseRepository
{
    /**
     * @var string
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     * @param string $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Formats column list to be used in query
     * @return array|string
     */
    protected function formatColumns() : array|string
    {
        $columnFormattedList = [];
        $fields = request()->has('fields') === false || request()->get('fields') === null
            ? ''
            : request()->get('fields');

        if (Str::length($fields) === 0) {
            return '*';
        }

        foreach (explode(',', $fields) as $columnName) {
            $hasPeriod = Str::contains($columnName, '.');
            if ($hasPeriod) {
                $relationshipColumn = explode('.', $columnName);
                $columnFormattedList[$relationshipColumn[0]][] = $relationshipColumn[1];
            } else {
                $columnFormattedList[] = $columnName;
            }
        }
        return $columnFormattedList;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data) : Model
    {
        return $this->model::create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return int
     */
    public function update(array $data, int $id) : int
    {
        return $this->model::find($id)->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model::find($id)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model::find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model::all();
    }
}
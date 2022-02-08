<?php
namespace App\Repositories;

/**
 * BaseRepository class
 * @author Kenneth Sumang
 */
class BaseRepository
{
    /**
     * @var string
     */
    protected string $model;

    /**
     * BaseRepository constructor.
     * @param string $model
     */
    public function __construct(string $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model::create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
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
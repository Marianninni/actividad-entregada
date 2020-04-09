<?php

namespace App\Repositories;

use App\Models\Faq;
use App\Contracts\FaqContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class FaqRepository extends BaseRepository implements FaqContract
{
    /**
     * AttributeRepository constructor.
     * @param Faq $model
     */
    public function __construct(Faq $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFaq(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findFaqById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createFaq(array $params)
    {
        try {
            $collection = collect($params);

            $is_filterable = $collection->has('is_filterable') ? 1 : 0;
            $is_required = $collection->has('is_required') ? 1 : 0;

            $merge = $collection->merge(compact('is_filterable', 'is_required'));

            $faq = new Faq($merge->all());

            $faq->save();

            return $faq;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFaq(array $params)
    {
        $faq = $this->findFaqById($params['id']);

        $collection = collect($params)->except('_token');

        $is_filterable = $collection->has('is_filterable') ? 1 : 0;
        $is_required = $collection->has('is_required') ? 1 : 0;

        $merge = $collection->merge(compact('is_filterable', 'is_required'));

        $faq->update($merge->all());

        return $faq;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFaq($id)
    {
        $faq = $this->findFaqById($id);

        $faq->delete();

        return $faq;
    }


    public function getValues(Request $request)
    {
        $faqId = $request->input('id');
        $faq = $this->faqRepository->findfaqById($faqId);

        $values = $faq->values;

        return response()->json($values);
    }


}
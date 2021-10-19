<?php

namespace App\Http\Controllers;

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="JSON Web token",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearer",
 * )
 */

/**
 * @OA\Parameter(
 *   name="query",
 *   in="query",
 *   description="A list of query to filter by columns - example: query=[{""column"":""name"",""operator"":""cont"",""text"":""lorem""}]",
 *   required=false,
 *   @OA\Items(
 *     type="string",
 *   ),
 * )
 */

/**
 * @OA\Parameter(
 *   name="sort",
 *   in="query",
 *   description="A query to sort by column - example: sort={""column"":""name"",""direction"":""desc""}",
 *   required=false,
 * )
 */

/**
 * @OA\Parameter(
 *   name="per-page",
 *   in="query",
 *   description="A number for items per page list - example: per-page=20",
 *   required=false,
 *   @OA\Items(
 *     type="number",
 *   ),
 * )
 */

/**
 * @OA\Parameter(
 *   name="page",
 *   in="query",
 *   description="A page number for paginated list - example: page=2",
 *   required=false,
 *   @OA\Items(
 *     type="number",
 *   ),
 * )
 */

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="NEXTGY",
 *      description="NEXTGY OpenApi Documentation",
 *      @OA\Contact(
 *          email="admin@nextgy.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="NEXTGY API Server"
 * )
 */
class ApiController extends Controller
{
    protected $perPage = 20;

    /**
     * Return a response error
     *
     * @param string $message
     * @param array $errors
     * @param integer $code
     * @param integer $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError(
        string $message = 'Error',
               $errors = [],
        int    $code = 400,
        int    $status = 1
    ): \Illuminate\Http\JsonResponse
    {
        $body = [
            'status' => $status,
            'message' => $message,
            'response' => [
                'errors' => $errors,
            ],
        ];

        return response()->json($body, $code);
    }

    /**
     * Return a success response
     *
     * @param string $message
     * @param array $data
     * @param bool $meta
     * @param bool $notify
     * @param integer $code
     * @param integer $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess(
        string $message = 'OK',
               $data = [],
        bool   $meta = true,
        bool   $notify = false,
        int    $code = 200,
        int    $status = 0
    ): \Illuminate\Http\JsonResponse
    {
        $lists = isset($data['lists']) ? $data['lists'] : null;
        unset($data['lists']);
        $body = [
            'status' => $status,
            'message' => $message,
            'notify' => $notify,
            'data' => isset($data['data']) ? ($this->getArrayData($data['data']) ?? $this->getData($data)) : $data,
            'lists' => $lists,
            'meta' => $meta ? ($data['meta'] ?? $this->getMeta($data)) : null,
        ];

        return response()->json($body, $code);
    }

    /**
     * Return a pagination meta array
     *
     * @param array $data
     * @return array
     */
    public function getMeta($data = []): array
    {
        if (!is_array($data)) {
            return [];
        }

        if (isset($data['data']) && null !== @$data['data']) {
            unset($data['data']);
            unset($data['lists']);
            return $data;
        }

        return $data;
    }

    /**
     * Return pagination data   array
     *
     * @param array $data
     * @return array
     */
    public function getData(array $data = []): array
    {
        if (isset($data['data']) && null !== @$data['data']) {
            return $this->getArrayData($data['data']);
        }

        return $this->getArrayData($data);
    }

    /**
     * Filter the query
     *
     * @param $request
     * @param $query
     * @return mixed
     */
    public function filtering($request, $query)
    {

        if (!$request->input('query')) {
            return $query;
        }

        $filterQuery = json_decode($request->input('query'));

        $keyCount = 0;
        foreach ($filterQuery as $key => $value) {

            $fieldParts = explode('.', $value->column);
            $field = $fieldParts[0] ?? $value->column;
            $relatedField = $fieldParts[1] ?? null;
            $operatorSymbol = $value->operator;
            $operator = null;
            $value = $value->text;

            if ($operatorSymbol == 'eq') {
                $operator = '=';
            } elseif ($operatorSymbol == 'cont') {
                $operator = 'like';
                if ($value && $value != '') {
                    $value = '%' . $value . '%';
                }
            } elseif ($operatorSymbol == 'gt') {
                $operator = '>=';
            } elseif ($operatorSymbol == 'lt') {
                $operator = '<=';
            } elseif ($operatorSymbol == 'notnull') {
                $operator = 'notNull';
            } elseif ($operatorSymbol == 'null') {
                $operator = 'null';
            } else {
                $operator = 'like';
                if ($value && $value != '') {
                    $value = '%' . $value . '%';
                }
            }

            if ($relatedField) {
                $filterJoin = ($keyCount > 0) ? 'orWhereHas' : 'orWhereHas';

                if ($value && $value != '') {
                    $query = $query->{$filterJoin}($field, function ($q) use ($field, $relatedField, $operator, $value) {
                        return $q->where($relatedField, $operator, $value);
                    });
                }

                $keyCount++;
            } else {

                if ($value && $value != '') {
                    $query = $query->orWhere($field, $operator, $value);
                }

            }

        }

        return $query;
    }

    /**
     * Sorting the query
     *
     * @param $request
     * @param $query
     * @return mixed
     */
    public function sorting($request, $query)
    {
        if (!$request->input('sort')) {
            return $query->sortByDesc('id');
        }

        $sort = json_decode($request->input('sort'));

        $query = $query->sortByDesc('id');

        if (isset($sort->column) && isset($sort->direction) && $sort->direction == 'asc') {
            $query = $query->sortBy($sort->column);
        }

        if (isset($sort->column) && isset($sort->direction) && $sort->direction == 'desc') {
            $query = $query->sortByDesc($sort->column);
        }

        return $query;
    }

    /**
     * @param $data
     * @return array
     */
    protected function getArrayData($data)
    {

        if (!is_array($data)) {
            return $data;
        }

        $array = [];

        foreach ($data as $key => $value) {
            $array[] = $value;
        }

        return $array;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Exports\UsersExport;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends ApiController
{

// generated section

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // user_can(['user.index']);

        // $users = new User;
        $users = User::with(User::getRelationships());

        // (1)filltering
        $users = $this->filtering($request, $users);
        $users = $users->get();

        // (2)sort
        $users = $this->sorting($request, $users);

        // (3)paginate
        $users = $users->paginate($request->get('per-page') ?? 10);

        $resource = $users->toArray();

        $resource['lists'] = User::getLists();

        return $this->responseSuccess(
            'Usuarios obtenidos!',
            $resource,
            true,
            false
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        // user_can(['user.create']);

        return response()->json([
            'message' => 'Formulario para crear usuario!',
            'data' => null,
            'lists' => User::getLists()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // user_can(['user.store']);

        $this->varidate($request);

        $input = $request->input('model');

        $input['password'] = bcrypt($input['password']);

        $input['name'] = $input['first_name'] . ' ' . $input['last_name'];

        DB::beginTransaction();
        try {
            //create data

            $user = User::create($input);

            $user->userRoles()->sync($input['user_role_ids']);

            //sync(attach/detach)
            if ($request->input('pivots')) {
                $this->sync($request->input('pivots'), $user);
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError(
                '' . $exception->getMessage(),
                [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ]
            );
        }
        DB::commit();

        return $this->responseSuccess(
            'Usuario almacenado!',
            $user->toArray(),
            false,
            false,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        // user_can(['user.show']);

        $user = User::with(User::getRelationships())->findOrFail($userId);

        $user->user_role_ids = collect($user->userRoles)->pluck('id');

        $resource = $user->toArray();
        $resource['lists'] = User::getLists();

        return $this->responseSuccess(
            'Usuario obtenido!',
            $resource,
            false,
            false,
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        // user_can(['user.edit']);

        $user = User::with(User::getRelationships())->findOrFail($userId);
        $user->user_role_ids = collect($user->userRoles)->pluck('id');

        return $this->responseSuccess(
            'Formulario para editar USUARIO!',
            [
                'model' => $user,
                'lists' => User::getLists(),
            ],
            false
        );
    }

    /**
     * Show the form for duplicating the specified resource.
     *
     * @param \App\User $user * @return \Illuminate\Http\Response
     */
    public function duplicate($userId)
    {
        // user_can(['user.duplicate']);

        $user = User::with(User::getRelationships())->findOrFail($userId);
        $user->id = null;
        $user->user_profile_ids = collect($user->userProfiles)->pluck('id');
        $user->coun_meeting_citation_ids = collect($user->counMeetingCitations)->pluck('id');
        $user->coun_member_ids = collect($user->counMembers)->pluck('id');
        $user->user_role_ids = collect($user->userRoles)->pluck('id');

        return $this->responseSuccess(
            'Formulario para duplicar USUARIO!',
            [
                'model' => $user,
                'lists' => User::getLists(),
            ],
            false
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user * @return \Illuminate\Http\Response
     */
    public function update($userId, Request $request)
    {

        // user_can(['user.update']);

        $user = User::findOrFail($userId);

        $this->varidate($request, $user);

        $input = $request->input('model');

        if ($input['password'] === '') {
            $input['password'] = $user->password;
        } elseif ($input['password'] !== $user->password) {
            $input['password'] = bcrypt($input['password']);
        }

        DB::beginTransaction();
        try {
            //update data
            $user->update($input);

            $user->userRoles()->sync($input['user_role_ids']);

            //sync(attach/detach)
            if ($request->get('pivots')) {
                $this->sync($request->get('pivots'), $user);
            }

        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError(
                '' . $exception->getMessage(),
                [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ]
            );
        }
        DB::commit();

        return $this->responseSuccess(
            'USUARIO actualizado!',
            $user->toArray(),
            false,
            false,
            202
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {

        // user_can(['user.destroy']);

        $user = User::findOrFail($userId);
        $user->delete();
        return $this->responseSuccess(
            'USUARIO eliminado!',
            $user->toArray(),
            false,
            false,
            203
        );
    }

    /**
     * Varidate input data.
     *
     * @return array
     */
    public function varidate(Request $request, User $user = null)
    {
        $request->validate(User::getValidateRule($user));
    }

    /**
     * sync pivot data
     *
     * @return void
     */
    public function sync($pivots_data, User $user)
    {
        foreach ($pivots_data as $pivot_child_model_name => $pivots) {

            $pivotIds = [];
            // remove 'id'
            foreach ($pivots as &$value) {
                if (array_key_exists('id', $value)) {
                    $pivotIds[] = $value['id'];
                    unset($value['id']);
                }
            }
            unset($value);

            $method = Str::camel(Str::plural($pivot_child_model_name));
            $user->$method()->sync($pivotIds);
        }
    }


// end section

    /**
     * Remove the specified resource from storage.
     *
     * @param  $tagId
     * @return JsonResponse|\Illuminate\Http\JsonResponse
     */
    public function destroyMultiple(Request $request)
    {
        // user_can(['tag.destroy']);
        if (count($request->get('ids'))) {
            foreach ($request->get('ids') as $id) {
                $tag = User::findOrFail($id);
                $tag->delete();
            }
        }

        return $this->responseSuccess(
            'Usuarios eliminados!',
            [],
            false,
            false,
            203
        );
    }

    public function export()  {
        return \Maatwebsite\Excel\Facades\Excel::download(new UsersExport(), 'users.xlsx');
    }

}

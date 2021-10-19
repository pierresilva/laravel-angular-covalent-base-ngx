<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserProfileController extends ApiController
{

// generated section

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // user_can(['user_profile.index']);

		// $userProfiles = new UserProfile;
	    $userProfiles = UserProfile::with(UserProfile::getRelationships());

		// (1)filltering
        $userProfiles = $this->filtering($request, $userProfiles);
        $userProfiles = $userProfiles->get();

        // (2)sort
        $userProfiles = $this->sorting($request, $userProfiles);

        // (3)paginate
        $userProfiles = $userProfiles->paginate($request->get('per_page') ?? 10);

        $resource = $userProfiles->toArray();

        $resource['lists'] = UserProfile::getLists();

        return $this->responseSuccess(
          'PERFILESDEUSUARIO obtenidos!',
          $resource,
          true,
          false
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // user_can(['user_profile.create']);

            return response()->json([
              'message' => 'Formulario para crear PERFILESDEUSUARIO!',
              'data' => null,
              'lists' => UserProfile::getLists()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user_can(['user_profile.store']);

        $this->varidate($request);

        $input = $request->input('model');

                                                                                                                                        
        DB::beginTransaction();
        try {
          //create data
          $userProfile = UserProfile::create( $input );

          //sync(attach/detach)
          if ($request->input('pivots')) {
            $this->sync($request->input('pivots'), $userProfile);
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
          'PERFILESDEUSUARIO almacenado!',
          $userProfile->toArray(),
          false,
          false,
          201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile     * @return \Illuminate\Http\Response
     */
    public function show($userProfileId)
    {
        // user_can(['user_profile.show']);

        $userProfile = UserProfile::with(UserProfile::getRelationships())->findOrFail($userProfileId);

                                                                                                        
        $resource = $userProfile->toArray();
        $resource['lists'] = UserProfile::getLists();

        return $this->responseSuccess(
          'PERFILESDEUSUARIO obtenido!',
          $resource,
          false,
          false,
          200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile     * @return \Illuminate\Http\Response
     */
    public function edit($userProfileId)
    {
        // user_can(['user_profile.edit']);

        $userProfile = UserProfile::with(UserProfile::getRelationships())->findOrFail($userProfileId);
                                                                                                        
        return $this->responseSuccess(
          'Formulario para editar PERFILESDEUSUARIO!',
          [
            'model' => $userProfile,
            'lists' => UserProfile::getLists(),
          ],
          false
        );
    }

	/**
	 * Show the form for duplicating the specified resource.
	 *
	 * @param \App\UserProfile  $userProfile	 * @return \Illuminate\Http\Response
	 */
	public function duplicate($userProfileId)
	{
        // user_can(['user_profile.duplicate']);

        $userProfile = UserProfile::with(UserProfile::getRelationships())->findOrFail($userProfileId);
        $userProfile->id = null;
                                                                                                        
        return $this->responseSuccess(
          'Formulario para duplicar PERFILESDEUSUARIO!',
          [
            'model' => $userProfile,
            'lists' => UserProfile::getLists(),
          ],
          false
        );
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile     * @return \Illuminate\Http\Response
     */
    public function update($userProfileId, Request $request)
    {

        // user_can(['user_profile.update']);

        $userProfile = UserProfile::findOrFail($userProfileId);

        $this->varidate($request, $userProfile);

        $input = $request->input('model');

                                                                                                                                        
        DB::beginTransaction();
        try {
          //update data
          $userProfile->update($input);

          //sync(attach/detach)
          if ($request->get('pivots')) {
            $this->sync($request->get('pivots'), $userProfile);
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
          'PERFILESDEUSUARIO actualizado!',
          $userProfile->toArray(),
          false,
          false,
          202
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile     * @return \Illuminate\Http\Response
     */
    public function destroy($userProfileId)
    {

        // user_can(['user_profile.destroy']);

        $userProfile = UserProfile::findOrFail($userProfileId);
        $userProfile->delete();
        return $this->responseSuccess(
          'PERFILESDEUSUARIO eliminado!',
          $userProfile->toArray(),
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
    public function varidate(Request $request, UserProfile $userProfile = null)
    {
        $request->validate(UserProfile::getValidateRule($userProfile));
    }

    /**
     * sync pivot data
     *
     * @return void
     */
    public function sync($pivots_data, UserProfile $userProfile)
    {
        foreach( $pivots_data as $pivot_child_model_name => $pivots ){

            $pivotIds = [];
            // remove 'id'
            foreach($pivots as &$value){
                if( array_key_exists('id', $value) ){
                    $pivotIds[] = $value['id'];
                    unset($value['id']);
                }
            }
            unset($value);

            $method = Str::camel( Str::plural($pivot_child_model_name) );
            $userProfile->$method()->sync($pivotIds);
        }
    }


// end section

}

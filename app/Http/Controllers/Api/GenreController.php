<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Exports\GenresExport;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @OA\Tag(
 *     name="Genres",
 *     description="API Endpoints of genres"
 * )
 */
class GenreController extends ApiController
{

// generated section

   /**
    * @OA\GET(
    *   path="/api/genres",
    *   tags={"Genres"},
    *   summary="Get list of genres",
    *   description="Returns list of genres",
    *   @OA\Parameter(ref="#/components/parameters/query"),
    *   @OA\Parameter(ref="#/components/parameters/sort"),
    *   @OA\Parameter(ref="#/components/parameters/per-page"),
    *   @OA\Parameter(ref="#/components/parameters/page"),
    *   @OA\Response(
    *     response=200,
    *     description="Paginated genres list."
    *   ),
    *   @OA\Response(
    *    response=400,
    *    description="Reponse error."
    *   )
    * )
    */
   public function index(Request $request)
   {
       // user_can(['genre.index']);

    // $genres = new Genre;
    $genres = Genre::with(Genre::getRelationships());

    // (1)filltering
       $genres = $this->filtering($request, $genres);
       $genres = $genres->get();

       // (2)sort
       $genres = $this->sorting($request, $genres);

       // (3)paginate
       $genres = $genres->paginate($request->get('per-page') ?? 10);

       $resource = $genres->toArray();

       $resource['lists'] = Genre::getLists();

       return $this->responseSuccess(
         'Genres list obtained!',
         $resource,
         true,
         false
       );
   }

   /**
    * @OA\POST(
    *   path="/api/genres",
    *   summary="Create genre",
    *   tags={"Genres"},
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns created new genre",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Genre",
    *       ),
    *     ),
    *   ),
    *   @OA\Response(
    *     response="201",
    *     description="Successful book created",
    *   ),
    *   @OA\Response(
    *     response="422",
    *     description="Validation error",
    *   ),
    * )
    */
   public function store(Request $request)
   {
       // user_can(['genre.store']);

       $this->varidate($request);

       $input = $request->input('model');

        $input['code'] = Str::slug($input['name']);

       DB::beginTransaction();
       try {
         //create data
         $genre = Genre::create( $input );

           if (isset($input['books']) && count($input['books'])) {
               foreach ($input['books'] as $book) {
                 \App\Models\Book::find($book['id'])->update(['genre_id' => $genre->id]);
               }
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
         'Genre stored!',
         $genre->toArray(),
         false,
         false,
         201
       );
   }

   /**
    * @OA\GET(
    *      path="/api/genres/{id}",
    *      tags={"Genres"},
    *      summary="Get genre data",
    *      description="Returns genre data",
    *      @OA\Parameter(
    *          name="id",
    *          description="Genre ID",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful get genre data"
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="Bad Request"
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Not Found"
    *      )
    * )
    */
   public function show($genreId)
   {
       // user_can(['genre.show']);

       $genre = Genre::with(Genre::getRelationships())->findOrFail($genreId);

       $genre->book_ids = collect($genre->books)->pluck('id');

       $resource = $genre->toArray();
       // $resource['lists'] = Genre::getLists();

       return $this->responseSuccess(
         'Genre data obtained!',
         $resource,
         false,
         false,
         200
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/genres/{id}",
    *   tags={"Genres"},
    *   summary="Update genre",
    *   description="Returns updated genre data",
    *   @OA\Parameter(
    *     name="id",
    *     description="Genre ID",
    *     required=true,
    *     in="path",
    *     @OA\Schema(
    *       type="integer"
    *     )
    *   ),
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns updated new genre",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Genre",
    *       ),
    *     ),
    *   ),
    *   @OA\Response(
    *     response="201",
    *     description="Successful book created",
    *   ),
    *   @OA\Response(
    *     response="422",
    *     description="Validation error",
    *   ),
    * )
    */
   public function update($genreId, Request $request)
   {

       // user_can(['genre.update']);

       $genre = Genre::findOrFail($genreId);

       $this->varidate($request, $genre);

       $input = $request->input('model');

       $input['code'] = Str::slug($input['name']);

       DB::beginTransaction();
       try {
         //update data
         $genre->update($input);

         if (isset($input['books']) && count($input['books'])) {
             \App\Models\Book::where('genre_id', $genreId)
             ->update(['genre_id' => null]);
             foreach ($input['books'] as $book) {
                 \App\Models\Book::find($book['id'])->update(['genre_id' => $genre->id]);
             }
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
         'Genre updated!',
         $genre->toArray(),
         false,
         false,
         202
       );
   }


   /**
    * @OA\DELETE(
    *      path="/api/genres/{id}",
    *      tags={"Genres"},
    *      summary="Delete existing genre",
    *      description="Delete a genre and returns it",
    *      @OA\Parameter(
    *          name="id",
    *          description="Genre ID",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=202,
    *          description="Successful operation",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Resource Not Found"
    *      )
    * )
    */
   public function destroy($genreId)
   {

       // user_can(['genre.destroy']);

       $genre = Genre::findOrFail($genreId);
       $genre->delete();
       return $this->responseSuccess(
         'GENRE deleted!',
         $genre->toArray(),
         false,
         false,
         203
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/genres/delete-multiple",
    *   tags={"Genres"},
    *   summary="Delete genres",
    *   description="Returns genres deleted",
    *   @OA\RequestBody(
    *     required=true,
    *     description="Array of ids to delete genres",
    *     @OA\JsonContent(
    *       type="object",
    *       required={"genre_ids"},
    *       @OA\Property(
    *         property="genre_ids",
    *         type="array",
    *         example={0: 1, 1: 2},
    *         @OA\Items(
    *           type="number",
    *         ),
    *       ),
    *     ),
    *   ),
    *   @OA\Response(
    *     response="202",
    *     description="Successful genres deleted",
    *   ),
    *   @OA\Response(
    *     response="422",
    *     description="Validation error",
    *   ),
    * )
    */
   public function destroyMultiple(Request $request)
   {
       // user_can(['tag.destroy']);

       if (!$request->get('genre_ids') || !count($request->get('genre_ids'))) {
           return $this->responseError('Validation error', [
               'errors' => [
                   'genre_ids' => 'No genre IDs found'
               ]
           ], 422);
       }

       if (count($request->get('genre_ids'))) {
           foreach ($request->get('genre_ids') as $id) {
               $tag = Genre::findOrFail($id);
               $tag->delete();
           }
       }

       return $this->responseSuccess(
           'Genres deleted!',
           [],
           false,
           false,
           203
       );
   }

   /**
    * @OA\GET(
    *      path="/api/genres/export",
    *      tags={"Genres"},
    *      summary="Get xls file of all genres",
    *      description="Returns list of all genres in a excel file",
    *      @OA\Response(
    *          response=200,
    *          description="Successful get genres xls file"
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="Bad Request"
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Not Found"
    *      )
    * )
    */
   public function export()  {
       return \Maatwebsite\Excel\Facades\Excel::download(new GenresExport(), 'genres.xlsx');
   }

   /**
    * Varidate input data.
    *
    * @return array
    */
   public function varidate(Request $request, Genre $genre = null)
   {
       $request->validate(Genre::getValidateRule($genre));
   }


// end section

}

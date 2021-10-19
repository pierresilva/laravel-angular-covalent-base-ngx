<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Exports\BooksExport;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @OA\Tag(
 *     name="Books",
 *     description="API Endpoints of books"
 * )
 */
class BookController extends ApiController
{

// generated section

   /**
    * @OA\GET(
    *   path="/api/books",
    *   tags={"Books"},
    *   summary="Get list of books",
    *   description="Returns list of books",
    *   @OA\Parameter(ref="#/components/parameters/query"),
    *   @OA\Parameter(ref="#/components/parameters/sort"),
    *   @OA\Parameter(ref="#/components/parameters/per-page"),
    *   @OA\Parameter(ref="#/components/parameters/page"),
    *   @OA\Response(
    *     response=200,
    *     description="Paginated books list."
    *   ),
    *   @OA\Response(
    *    response=400,
    *    description="Reponse error."
    *   )
    * )
    */
   public function index(Request $request)
   {
       // user_can(['book.index']);

    // $books = new Book;
    $books = Book::with(Book::getRelationships());

    // (1)filltering
       $books = $this->filtering($request, $books);
       $books = $books->get();

       // (2)sort
       $books = $this->sorting($request, $books);

       // (3)paginate
       $books = $books->paginate($request->get('per-page') ?? 10);

       $resource = $books->toArray();

       $resource['lists'] = Book::getLists();

       return $this->responseSuccess(
         'Books list obtained!',
         $resource,
         true,
         false
       );
   }

   /**
    * @OA\POST(
    *   path="/api/books",
    *   summary="Create book",
    *   tags={"Books"},
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns created new book",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Book",
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
       // user_can(['book.store']);

       $this->varidate($request);

       $input = $request->input('model');

        $input['code'] = Str::slug($input['title']);

       DB::beginTransaction();
       try {
         //create data
         $book = Book::create( $input );

           if ($request->input('model.tag_ids')) {
               $book->tags()->sync($request->input('model.tag_ids'));
           }
           if ($request->input('model.author_ids')) {
               $book->authors()->sync($request->input('model.author_ids'));
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
         'Book stored!',
         $book->toArray(),
         false,
         false,
         201
       );
   }

   /**
    * @OA\GET(
    *      path="/api/books/{id}",
    *      tags={"Books"},
    *      summary="Get book data",
    *      description="Returns book data",
    *      @OA\Parameter(
    *          name="id",
    *          description="Book ID",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful get book data"
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
   public function show($bookId)
   {
       // user_can(['book.show']);

       $book = Book::with(Book::getRelationships())->findOrFail($bookId);

       $book->tag_ids = collect($book->tags)->pluck('id');
       $book->author_ids = collect($book->authors)->pluck('id');

       $resource = $book->toArray();
       // $resource['lists'] = Book::getLists();

       return $this->responseSuccess(
         'Book data obtained!',
         $resource,
         false,
         false,
         200
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/books/{id}",
    *   tags={"Books"},
    *   summary="Update book",
    *   description="Returns updated book data",
    *   @OA\Parameter(
    *     name="id",
    *     description="Book ID",
    *     required=true,
    *     in="path",
    *     @OA\Schema(
    *       type="integer"
    *     )
    *   ),
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns updated new book",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Book",
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
   public function update($bookId, Request $request)
   {

       // user_can(['book.update']);

       $book = Book::findOrFail($bookId);

       $this->varidate($request, $book);

       $input = $request->input('model');

       $input['code'] = Str::slug($input['title']);

       DB::beginTransaction();
       try {
         //update data
         $book->update($input);

        $request->input('model.tag_ids') ? $book->tags()->sync($request->input('model.tag_ids')) : $book->tags()->detach();
        $request->input('model.author_ids') ? $book->authors()->sync($request->input('model.author_ids')) : $book->authors()->detach();

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
         'Book updated!',
         $book->toArray(),
         false,
         false,
         202
       );
   }


   /**
    * @OA\DELETE(
    *      path="/api/books/{id}",
    *      tags={"Books"},
    *      summary="Delete existing book",
    *      description="Delete a book and returns it",
    *      @OA\Parameter(
    *          name="id",
    *          description="Book ID",
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
   public function destroy($bookId)
   {

       // user_can(['book.destroy']);

       $book = Book::findOrFail($bookId);
       $book->delete();
       return $this->responseSuccess(
         'BOOK deleted!',
         $book->toArray(),
         false,
         false,
         203
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/books/delete-multiple",
    *   tags={"Books"},
    *   summary="Delete books",
    *   description="Returns books deleted",
    *   @OA\RequestBody(
    *     required=true,
    *     description="Array of ids to delete books",
    *     @OA\JsonContent(
    *       type="object",
    *       required={"book_ids"},
    *       @OA\Property(
    *         property="book_ids",
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
    *     description="Successful books deleted",
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

       if (!$request->get('book_ids') || !count($request->get('book_ids'))) {
           return $this->responseError('Validation error', [
               'errors' => [
                   'book_ids' => 'No book IDs found'
               ]
           ], 422);
       }

       if (count($request->get('book_ids'))) {
           foreach ($request->get('book_ids') as $id) {
               $tag = Book::findOrFail($id);
               $tag->delete();
           }
       }

       return $this->responseSuccess(
           'Books deleted!',
           [],
           false,
           false,
           203
       );
   }

   /**
    * @OA\GET(
    *      path="/api/books/export",
    *      tags={"Books"},
    *      summary="Get xls file of all books",
    *      description="Returns list of all books in a excel file",
    *      @OA\Response(
    *          response=200,
    *          description="Successful get books xls file"
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
       return \Maatwebsite\Excel\Facades\Excel::download(new BooksExport(), 'books.xlsx');
   }

   /**
    * Varidate input data.
    *
    * @return array
    */
   public function varidate(Request $request, Book $book = null)
   {
       $request->validate(Book::getValidateRule($book));
   }


// end section

}

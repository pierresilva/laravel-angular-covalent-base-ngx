import {Component, OnDestroy, OnInit} from '@angular/core';
import {environment} from "@env/environment";
import {Editor} from "ngx-editor";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";
import {BookService} from "@app/admin/books/services/book.service";
import {BooksListComponent} from "@app/admin/books/components/books-list/books-list.component";

@Component({
  selector: 'app-books-form',
  templateUrl: './books-form.component.html',
  styleUrls: ['./books-form.component.scss']
})
export class BooksFormComponent implements OnInit, OnDestroy {

  public editor_resume: Editor | any;
  public files: File | FileList | any;
  disabled: boolean = false;
  hour = '23:59:59';

  environment = environment;

  constructor(
    public bookService: BookService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService,
    public booksListComponent: BooksListComponent,
  ) {
    this.editor_resume = new Editor();
  }

  ngOnInit(): void {
  }

  ngOnDestroy(): void {
    this.editor_resume.destroy();
  }

  selectCoverEvent(files: FileList | File): void {
    if (files instanceof FileList) {

      } else {
        let formData = new FormData();
          formData.set('file', files);
          this.api.post('/api/uploads', formData)
            .subscribe(
              (response: any) => {
                this.bookService.model.cover = response.data.url;
                this.snackBar.success(response.message);
              },
              (error: any) => {
                this.snackBar.warning(error.errors.file[0]);
              }
            );
      }
  }


// Genre

  setGenre(genre: any) {
      if (!genre) {
        this.bookService.model.genre = null;
      }
      this.bookService.model.genre = genre;
    }

    setGenreId(genreId: any) {
      if (!genreId) {
        this.bookService.model.genre_id = null;
      }
      this.bookService.model.genre_id = genreId;
    }

// Tags

  setTags(tags: any[]) {
    if (!tags.length) {
      this.bookService.model.tags = [];
    }
    this.bookService.model.tags = tags;
  }
  setTagIds(tagIds: any[]) {
    if (!tagIds.length) {
      this.bookService.model.tag_ids = null;
    }
    this.bookService.model.tag_ids = tagIds;
  }

// Authors

  setAuthors(authors: any[]) {
    if (!authors.length) {
      this.bookService.model.authors = [];
    }
    this.bookService.model.authors = authors;
  }
  setAuthorIds(authorIds: any[]) {
    if (!authorIds.length) {
      this.bookService.model.author_ids = null;
    }
    this.bookService.model.author_ids = authorIds;
  }


}

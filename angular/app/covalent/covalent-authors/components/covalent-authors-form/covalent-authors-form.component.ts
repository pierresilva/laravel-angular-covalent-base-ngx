import {Component, OnDestroy, OnInit} from '@angular/core';
import {Editor} from 'ngx-editor';

import {AuthorService} from "@app/covalent/covalent-authors/services/author.service";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";

@Component({
  selector: 'app-covalent-authors-form',
  templateUrl: './covalent-authors-form.component.html',
  styleUrls: ['./covalent-authors-form.component.scss']
})
export class CovalentAuthorsFormComponent implements OnInit, OnDestroy {

  editor: Editor;

  files: File | FileList | any;
  disabled: boolean = false;

  hour = '23:45:08';

  constructor(
    public authorService: AuthorService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService
  ) {
    this.editor = new Editor();
  }

  ngOnInit(): void {

  }

  ngOnDestroy(): void {
    this.editor.destroy();
  }

  // Uploads

  selectEvent(files: FileList | File): void {
    if (files instanceof FileList) {

    } else {
      let formData = new FormData();
      formData.set('file', files);
      this.api.post('/api/uploads', formData)
        .subscribe(
          (response: any) => {
            this.authorService.model.cover = response.data.url;
            this.snackBar.success(response.message);
          },
          (error: any) => {
            this.snackBar.warning(error.errors.file[0]);
          }
        );
    }
  }

  uploadEvent(files: FileList | File): void {
    if (files instanceof FileList) {

    } else {

    }
  }

  cancelEvent(): void {

  }

  // Authors
  setAuthors(authors: any[]) {
    if (!this.authorService.model.authors) {
      this.authorService.model.authors = [];
    }
    this.authorService.model.authors = authors;
  }

  setAuthorIds(authorIds: any[]) {
    if (!this.authorService.model.author_ids) {
      this.authorService.model.author_ids = [];
    }
    this.authorService.model.author_ids = authorIds;
  }

  // Tags
  setTags(tags: any[]) {
    if (!this.authorService.model.tags) {
      this.authorService.model.tags = [];
    }
    this.authorService.model.tags = tags;
  }

  setTagIds(tagIds: any[]) {
    if (!this.authorService.model.tag_ids) {
      this.authorService.model.tag_ids = [];
    }
    this.authorService.model.tag_ids = tagIds;
  }

  // Genre
  setGenreId(genreIds: any[]) {
    this.authorService.model.genre_id = genreIds[0];
  }

  setGenre(genres: any[]) {
    this.authorService.model.genre = genres[0];
  }

}

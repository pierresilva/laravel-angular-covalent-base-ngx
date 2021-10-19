import { Component, OnInit } from '@angular/core';
import {MediaObserver} from "@angular/flex-layout";
import {TdMediaService} from "@covalent/core/media";
import {TdDataTableService} from "@covalent/core/data-table";
import {TdDialogService} from "@covalent/core/dialogs";
import {InternalDocsService} from "@shared/services/internal-docs.service";
import {BookService} from "@app/about/services/book.service";
import {TdLoadingService} from "@covalent/core/loading";

@Component({
  selector: 'app-about-list',
  templateUrl: './about-list.component.html',
  styleUrls: ['./about-list.component.scss']
})
export class AboutListComponent implements OnInit {

  constructor(
    private mediaObserver: MediaObserver,
    public media: TdMediaService,
    private _dataTableService: TdDataTableService,
    private _dialogService: TdDialogService,
    private _internalDocsService: InternalDocsService,
    public bookService: BookService,
    private _loadingService: TdLoadingService
  ) { }

  ngOnInit(): void {
    this.bookService.getItems();
  }

  get isMobile(): boolean {
    return this.mediaObserver.isActive('xs') || this.mediaObserver.isActive('sm');
  }


}

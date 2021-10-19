import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { BooksRoutingModule } from './books-routing.module';
import { BooksListComponent } from './components/books-list/books-list.component';
import { BooksFormComponent } from './components/books-form/books-form.component';
import { BooksSidenavComponent } from './components/books-sidenav/books-sidenav.component';
import { BooksComponent } from './books.component';
import { SharedModule } from "@shared";


@NgModule({
  declarations: [
    BooksListComponent,
    BooksFormComponent,
    BooksSidenavComponent,
    BooksComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    BooksRoutingModule
  ]
})
export class BooksModule { }

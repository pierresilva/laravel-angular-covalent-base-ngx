import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BooksComponent } from "@app/admin/books/books.component";
import { BooksListComponent } from "@app/admin/books/components/books-list/books-list.component";

const routes: Routes = [
  {
    path: '',
    component: BooksComponent,
    children: [
      {
        path: '',
        component: BooksListComponent,
      },
      {
        path: ':id',
        component: BooksListComponent,
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BooksRoutingModule { }

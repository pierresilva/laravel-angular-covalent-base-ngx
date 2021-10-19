import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthorsComponent } from "@app/admin/authors/authors.component";
import { AuthorsListComponent } from "@app/admin/authors/components/authors-list/authors-list.component";

const routes: Routes = [
  {
    path: '',
    component: AuthorsComponent,
    children: [
      {
        path: '',
        component: AuthorsListComponent,
      },
      {
        path: ':id',
        component: AuthorsListComponent,
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AuthorsRoutingModule { }

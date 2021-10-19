import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {AdminLayoutMainComponent} from "@app/admin/@layout/admin-layout-main/admin-layout-main.component";
import {AdminComponent} from "@app/admin/admin.component";

const routes: Routes = [
  {
    path: '',
    component: AdminLayoutMainComponent,
    children: [
      {
        path: '',
        component: AdminComponent
      },
      {
        path: 'users',
        loadChildren: () => import('./users/users.module').then(m => m.UsersModule)
      },
      {
        path: 'roles',
        loadChildren: () => import('./roles/roles.module').then(m => m.RolesModule)
      },
      {
        path: 'permissions',
        loadChildren: () => import('./permissions/permissions.module').then(m => m.PermissionsModule)
      },
      {
        path: 'books',
        loadChildren: () => import('./books/books.module').then(m => m.BooksModule)
      },
      {
        path: 'authors',
        loadChildren: () => import('./authors/authors.module').then(m => m.AuthorsModule)
      },
      {
        path: 'tags',
        loadChildren: () => import('./tags/tags.module').then(m => m.TagsModule)
      },
      {
        path: 'genres',
        loadChildren: () => import('./genres/genres.module').then(m => m.GenresModule)
      },
    ]
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule { }

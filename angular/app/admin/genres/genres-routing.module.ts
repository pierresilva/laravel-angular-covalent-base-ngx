import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { GenresComponent } from "@app/admin/genres/genres.component";
import { GenresListComponent } from "@app/admin/genres/components/genres-list/genres-list.component";

const routes: Routes = [
  {
    path: '',
    component: GenresComponent,
    children: [
      {
        path: '',
        component: GenresListComponent,
      },
      {
        path: ':id',
        component: GenresListComponent,
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class GenresRoutingModule { }

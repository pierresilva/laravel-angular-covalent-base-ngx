import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {ManageListComponent} from "@app/admin/library/@libary-layout/components/components/manage-list/manage-list.component";
import {LibraryComponent} from "@app/admin/library/library.component";

const routes: Routes = [
  {
    path: '',
    component: ManageListComponent,
    children:  [
      {
        path: '',
        component: LibraryComponent
      },
      {
        path: 'tags',
        loadChildren: () => import('./tags/tags.module').then(m => m.TagsModule)
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class LibraryRoutingModule { }

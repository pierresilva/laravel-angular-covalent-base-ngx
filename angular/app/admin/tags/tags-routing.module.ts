import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TagsComponent } from "@app/admin/tags/tags.component";
import { TagsListComponent } from "@app/admin/tags/components/tags-list/tags-list.component";

const routes: Routes = [
  {
    path: '',
    component: TagsComponent,
    children: [
      {
        path: '',
        component: TagsListComponent,
      },
      {
        path: ':id',
        component: TagsListComponent,
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TagsRoutingModule { }

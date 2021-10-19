import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {PermissionsListComponent} from "@app/admin/permissions/components/permissions-list/permissions-list.component";

const routes: Routes = [
  {
    path: '',
    component: PermissionsListComponent,
  },
  {
    path: ':id',
    component: PermissionsListComponent,
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PermissionsRoutingModule { }

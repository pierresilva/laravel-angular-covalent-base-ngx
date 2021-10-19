import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {RolesListComponent} from "@app/admin/roles/components/roles-list/roles-list.component";

const routes: Routes = [
  {
    path: '',
    component: RolesListComponent
  },
  {
    path: ':id',
    component: RolesListComponent
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class RolesRoutingModule { }

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PermissionsRoutingModule } from './permissions-routing.module';
import { PermissionsFormComponent } from './components/permissions-form/permissions-form.component';
import { PermissionsListComponent } from './components/permissions-list/permissions-list.component';
import { PermissionsSidenavComponent } from './components/permissions-sidenav/permissions-sidenav.component';
import {SharedModule} from "@shared";


@NgModule({
  declarations: [
    PermissionsFormComponent,
    PermissionsListComponent,
    PermissionsSidenavComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    PermissionsRoutingModule
  ]
})
export class PermissionsModule { }

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { RolesRoutingModule } from './roles-routing.module';
import { RolesFormComponent } from './components/roles-form/roles-form.component';
import { RolesListComponent } from './components/roles-list/roles-list.component';
import { RolesSidenavComponent } from './components/roles-sidenav/roles-sidenav.component';
import {SharedModule} from "@shared";
import { RolesComponent } from './roles.component';


@NgModule({
  declarations: [
    RolesFormComponent,
    RolesListComponent,
    RolesSidenavComponent,
    RolesComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    RolesRoutingModule
  ]
})
export class RolesModule { }

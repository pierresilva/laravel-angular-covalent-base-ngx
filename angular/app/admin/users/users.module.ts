import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UsersRoutingModule } from './users-routing.module';
import { UsersListComponent } from './components/users-list/users-list.component';
import { UsersFormComponent } from './components/users-form/users-form.component';
import { UsersSidenavComponent } from './components/users-sidenav/users-sidenav.component';
import {SharedModule} from "@shared";
import { UsersComponent } from './users.component';


@NgModule({
  declarations: [
    UsersListComponent,
    UsersFormComponent,
    UsersSidenavComponent,
    UsersComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    UsersRoutingModule
  ]
})
export class UsersModule { }

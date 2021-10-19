import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {CovalentRoutingModule} from './covalent-routing.module';
import {SharedModule} from "@shared";

import { CovalentModuleMenuComponent } from './@components/covalent-module-menu/covalent-module-menu.component';
import {CovalentLayoutManageListComponent} from './@layouts/covalent-layout-manage-list/covalent-layout-manage-list.component';


@NgModule({
  declarations: [
    CovalentLayoutManageListComponent,
    CovalentModuleMenuComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    CovalentRoutingModule
  ]
})
export class CovalentModule {
}

import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {SharedModule} from "@shared";
import {LibraryRoutingModule} from './library-routing.module';

import {ManageListComponent} from './@libary-layout/components/components/manage-list/manage-list.component';
import {LibraryComponent} from './library.component';
import { ModuleMenuComponent } from './@libary-layout/components/components/module-menu/module-menu.component';


@NgModule({
  declarations: [
    LibraryComponent,
    ManageListComponent,
    ModuleMenuComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    LibraryRoutingModule
  ]
})
export class LibraryModule {
}

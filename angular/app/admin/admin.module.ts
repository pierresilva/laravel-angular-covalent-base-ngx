import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {AdminRoutingModule} from './admin-routing.module';
import {AdminComponent} from './admin.component';
import {SharedModule} from "@shared";
import {CovalentBaseEchartsModule} from "@covalent/echarts/base";
import {NgxChartsModule} from "@swimlane/ngx-charts";
import { AdminLayoutMainComponent } from './@layout/admin-layout-main/admin-layout-main.component';
import { AdminMenuMainComponent } from './@components/admin-menu-main/admin-menu-main.component';


@NgModule({
  declarations: [
    AdminComponent,
    AdminLayoutMainComponent,
    AdminMenuMainComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    CovalentBaseEchartsModule,
    NgxChartsModule,
    AdminRoutingModule
  ]
})
export class AdminModule {
}

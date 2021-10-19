import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UserRoutingModule } from './user-routing.module';
import { UserComponent } from './user.component';
import {SharedModule} from "@shared";
import {CovalentBaseEchartsModule} from "@covalent/echarts/base";
import {NgxChartsModule} from "@swimlane/ngx-charts";


@NgModule({
  declarations: [
    UserComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    CovalentBaseEchartsModule,
    NgxChartsModule,
    UserRoutingModule
  ]
})
export class UserModule { }

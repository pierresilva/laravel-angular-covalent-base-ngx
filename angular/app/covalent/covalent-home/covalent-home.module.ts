import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CovalentHomeRoutingModule } from './covalent-home-routing.module';
import { CovalentHomeComponent } from './covalent-home.component';
import {SharedModule} from "@shared";


@NgModule({
  declarations: [
    CovalentHomeComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    CovalentHomeRoutingModule
  ]
})
export class CovalentHomeModule { }

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { NotificationsRoutingModule } from './notifications-routing.module';
import { NotificationsComponent } from './notifications.component';
import {SharedModule} from "@shared";
import { NotificationsDetailComponent } from './components/notifications-detail/notifications-detail.component';


@NgModule({
  declarations: [
    NotificationsComponent,
    NotificationsDetailComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    NotificationsRoutingModule
  ]
})
export class NotificationsModule { }

import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {NotificationsComponent} from "@app/user/notifications/notifications.component";
import {NotificationsDetailComponent} from "@app/user/notifications/components/notifications-detail/notifications-detail.component";

const routes: Routes = [
  {
    path: '',
    component: NotificationsComponent
  },
  {
    path: ':id',
    component: NotificationsDetailComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class NotificationsRoutingModule {
}

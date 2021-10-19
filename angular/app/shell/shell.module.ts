import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { SharedModule } from '@shared';

import { I18nModule } from '@app/i18n';
import { AuthModule } from '@app/auth';
import { ShellComponent } from './shell.component';
import { ShellMenuComponent } from './components/shell-menu/shell-menu.component';
import { ShellMenuDrawerComponent } from './components/shell-menu-drawer/shell-menu-drawer.component';
import { ShellNotificationsComponent } from './components/shell-notifications/shell-notifications.component';

@NgModule({
  imports: [
    CommonModule,
    SharedModule,
    AuthModule,
    I18nModule,
    RouterModule
  ],
  declarations: [
    ShellComponent,
    ShellMenuComponent,
    ShellMenuDrawerComponent,
    ShellNotificationsComponent
  ]
})
export class ShellModule {
}

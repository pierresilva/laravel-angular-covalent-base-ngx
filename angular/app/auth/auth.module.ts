import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {SharedModule} from '@shared';
import {I18nModule} from "@app/i18n";
import {AuthRoutingModule} from './auth-routing.module';
import {LoginComponent} from './login.component';

@NgModule({
  imports: [
    CommonModule,
    SharedModule,
    I18nModule,
    AuthRoutingModule,
  ],
  declarations: [
    LoginComponent
  ]
})
export class AuthModule {
}

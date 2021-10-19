import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {RouteReuseStrategy, RouterModule} from '@angular/router';
import {HTTP_INTERCEPTORS} from '@angular/common/http';
import {ServiceWorkerModule} from '@angular/service-worker';
import {TranslateModule} from '@ngx-translate/core';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';

import {environment} from '@env/environment';
import {
  RouteReusableStrategy,
  ApiPrefixInterceptor,
  ErrorHandlerInterceptor,
  LoadingInterceptor,
  SharedModule,
  JwtInterceptor
} from '@shared';
import {AuthModule} from '@app/auth';
import {HomeModule} from './home/home.module';
import {ShellModule} from './shell/shell.module';
import {AppComponent} from './app.component';
import {AppRoutingModule} from './app-routing.module';
import {I18nModule} from "@app/i18n";
import {HashLocationStrategy, LocationStrategy} from "@angular/common";
// import { IonicModule } from '@ionic/angular';

@NgModule({
  imports: [
    BrowserModule,
    ServiceWorkerModule.register('./ngsw-worker.js', {enabled: environment.production}),
    RouterModule,
    TranslateModule.forRoot(),
    BrowserAnimationsModule,
    SharedModule,
    ShellModule,
    HomeModule,
    AuthModule,
    AppRoutingModule,
    // IonicModule.forRoot() // must be imported as the last module as it contains the fallback route
  ],
  declarations: [AppComponent],
  providers: [
    {
      provide: 'WINDOW',
      useValue: window,
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: JwtInterceptor,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: ApiPrefixInterceptor,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: LoadingInterceptor,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: ErrorHandlerInterceptor,
      multi: true
    },
    {
      provide: RouteReuseStrategy,
      useClass: RouteReusableStrategy
    },
    {
      provide: LocationStrategy,
      useClass: HashLocationStrategy
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule {
}

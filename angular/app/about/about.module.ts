import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AboutRoutingModule } from './about-routing.module';
import { AboutComponent } from './about.component';
import { SharedModule } from '@app/@shared';
import { AboutListComponent } from './components/about-list/about-list.component';
import { AboutFormComponent } from './components/about-form/about-form.component';
import { AboutViewComponent } from './components/about-view/about-view.component';
import { BookListAltComponent } from './components/book-list-alt/book-list-alt.component';


@NgModule({
  imports: [
    CommonModule,
    SharedModule,
    AboutRoutingModule
  ],
  declarations: [
    AboutComponent,
    AboutListComponent,
    AboutFormComponent,
    AboutViewComponent,
    BookListAltComponent,
  ]
})
export class AboutModule { }

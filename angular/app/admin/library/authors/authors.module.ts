import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AuthorsRoutingModule } from './authors-routing.module';
import { AuthorsFormComponent } from './components/authors-form/authors-form.component';
import { AuthorsViewComponent } from './components/authors-view/authors-view.component';
import { AuthorsListComponent } from './components/authors-list/authors-list.component';


@NgModule({
  declarations: [
    AuthorsFormComponent,
    AuthorsViewComponent,
    AuthorsListComponent
  ],
  imports: [
    CommonModule,
    AuthorsRoutingModule
  ]
})
export class AuthorsModule { }

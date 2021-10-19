import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AuthorsRoutingModule } from './authors-routing.module';
import { AuthorsListComponent } from './components/authors-list/authors-list.component';
import { AuthorsFormComponent } from './components/authors-form/authors-form.component';
import { AuthorsSidenavComponent } from './components/authors-sidenav/authors-sidenav.component';
import { AuthorsComponent } from './authors.component';
import { SharedModule } from "@shared";


@NgModule({
  declarations: [
    AuthorsListComponent,
    AuthorsFormComponent,
    AuthorsSidenavComponent,
    AuthorsComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    AuthorsRoutingModule
  ]
})
export class AuthorsModule { }

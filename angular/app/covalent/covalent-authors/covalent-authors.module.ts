import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {CovalentAuthorsRoutingModule} from './covalent-authors-routing.module';
import {CovalentAuthorsComponent} from './covalent-authors.component';
import {CovalentAuthosListComponent} from './components/covalent-authos-list/covalent-authos-list.component';
import {CovalentAuthorsViewComponent} from './components/covalent-authors-view/covalent-authors-view.component';
import {CovalentAuthorsFormComponent} from './components/covalent-authors-form/covalent-authors-form.component';
import {SharedModule} from "@shared";
import { CovalentAuthorsSidenavComponent } from './components/covalent-authors-sidenav/covalent-authors-sidenav.component';


@NgModule({
  declarations: [
    CovalentAuthorsComponent,
    CovalentAuthosListComponent,
    CovalentAuthorsViewComponent,
    CovalentAuthorsFormComponent,
    CovalentAuthorsSidenavComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    CovalentAuthorsRoutingModule
  ]
})
export class CovalentAuthorsModule {
}

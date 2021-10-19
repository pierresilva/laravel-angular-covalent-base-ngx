import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {CovalentAuthorsComponent} from "@app/covalent/covalent-authors/covalent-authors.component";
import {CovalentAuthosListComponent} from "@app/covalent/covalent-authors/components/covalent-authos-list/covalent-authos-list.component";

const routes: Routes = [
  {
    path: '',
    component: CovalentAuthorsComponent,
    children:   [
      {
        path: '',
        component: CovalentAuthosListComponent,
      },
      {
        path: ':id',
        component: CovalentAuthosListComponent,
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CovalentAuthorsRoutingModule { }

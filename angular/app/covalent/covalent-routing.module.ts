import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {CovalentLayoutManageListComponent} from "@app/covalent/@layouts/covalent-layout-manage-list/covalent-layout-manage-list.component";

const routes: Routes = [
  {
    path: '',
    component: CovalentLayoutManageListComponent,
    children: [
      {
        path: '',
        loadChildren: () => import('./covalent-home/covalent-home.module').then(m => m.CovalentHomeModule),
      },
      {
        path: 'authors',
        loadChildren: () => import('./covalent-authors/covalent-authors.module').then(m => m.CovalentAuthorsModule),
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CovalentRoutingModule {
}

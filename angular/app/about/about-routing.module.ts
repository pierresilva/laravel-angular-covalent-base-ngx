import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {marker} from '@biesbjerg/ngx-translate-extract-marker';

import {AboutComponent} from './about.component';
import {AboutListComponent} from "@app/about/components/about-list/about-list.component";
import {BookListAltComponent} from "@app/about/components/book-list-alt/book-list-alt.component";

const routes: Routes = [
  // Module is lazy loaded, see app-routing.module.ts
  {
    path: '',
    component: AboutComponent,
    data: {
      title: marker('About')
    },
    children: [
      {
        path: '',
        component: AboutListComponent
      },
      {
        path: 'list-alt',
        component: BookListAltComponent
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
  providers: []
})
export class AboutRoutingModule {
}

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { TagsRoutingModule } from './tags-routing.module';
import { TagsListComponent } from './components/tags-list/tags-list.component';
import { TagsFormComponent } from './components/tags-form/tags-form.component';
import { TagsSidenavComponent } from './components/tags-sidenav/tags-sidenav.component';
import { TagsComponent } from './tags.component';
import { SharedModule } from "@shared";


@NgModule({
  declarations: [
    TagsListComponent,
    TagsFormComponent,
    TagsSidenavComponent,
    TagsComponent,
  ],
  imports: [
    CommonModule,
    SharedModule,
    TagsRoutingModule
  ]
})
export class TagsModule { }

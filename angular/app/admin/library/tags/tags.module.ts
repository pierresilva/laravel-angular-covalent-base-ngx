import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { TagsRoutingModule } from './tags-routing.module';
import { TagsListComponent } from './components/tags-list/tags-list.component';
import { TagsFormComponent } from './components/tags-form/tags-form.component';
import { TagsViewComponent } from './components/tags-view/tags-view.component';
import { TagsComponent } from './tags.component';


@NgModule({
  declarations: [
    TagsListComponent,
    TagsFormComponent,
    TagsViewComponent,
    TagsComponent
  ],
  imports: [
    CommonModule,
    TagsRoutingModule
  ]
})
export class TagsModule { }
